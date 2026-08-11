/**
 * Run all parity measure/verify scripts. Exit 1 if any fail.
 * Usage: node scripts/verify-all.mjs [localUrl]
 */
import { spawn } from 'node:child_process';
import path from 'node:path';
import { fileURLToPath } from 'node:url';

const __dirname = path.dirname(fileURLToPath(import.meta.url));
const root = path.resolve(__dirname, '..');
const local = process.argv[2] || 'http://127.0.0.1:8000/';

const steps = [
  { name: 'verify-merch-motion', cmd: 'node', args: ['scripts/verify-merch-motion.mjs', local] },
  { name: 'measure-merch', cmd: 'node', args: ['scripts/measure-merch.mjs', local] },
  { name: 'measure-home-hero', cmd: 'node', args: ['scripts/measure-home-hero.mjs', local] },
  { name: 'measure-chrome', cmd: 'node', args: ['scripts/measure-chrome.mjs', local] },
];

function runStep(step) {
  return new Promise((resolve, reject) => {
    const child = spawn(step.cmd, step.args, { cwd: root, shell: true, stdio: ['ignore', 'pipe', 'pipe'] });
    let out = '';
    child.stdout.on('data', (d) => (out += d));
    child.stderr.on('data', (d) => (out += d));
    child.on('close', (code) => {
      if (code === 0) {
        resolve({ step: step.name, ok: true, out: out.trim() });
      } else {
        reject({ step: step.name, ok: false, code, out: out.trim() });
      }
    });
  });
}

const results = [];
let failed = false;

for (const step of steps) {
  try {
    const r = await runStep(step);
    results.push(r);
    console.log(`✓ ${step.name}`);
  } catch (e) {
    failed = true;
    results.push(e);
    console.error(`✗ ${step.name} (exit ${e.code})`);
    if (e.out) console.error(e.out.slice(0, 500));
  }
}

console.log(JSON.stringify({ ok: !failed, results: results.map((r) => ({ step: r.step, ok: r.ok })) }, null, 2));
process.exit(failed ? 1 : 0);
