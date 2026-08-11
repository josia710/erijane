# Animation Reference

> Cinematic motion design extracted from live DOM. Follow these specs exactly to recreate the experience.

## Motion Technology Stack

Pure CSS animations — no external animation libraries detected.

## Scroll Journey

The page is **900px** tall. Each frame below shows what the user sees at that scroll depth.

> **Use these screenshots to understand WHAT animates, WHEN it animates, and HOW it moves.**

### 0% — Top / Hero
Scroll position: 0px

![Scroll 0%](../screens/scroll/scroll-000.png)

### 17% — Opening Section
Scroll position: 0px

![Scroll 17%](../screens/scroll/scroll-017.png)

### 33% — First Feature Section
Scroll position: 0px

![Scroll 33%](../screens/scroll/scroll-033.png)

### 50% — Mid-Page
Scroll position: 0px

![Scroll 50%](../screens/scroll/scroll-050.png)

### 67% — Lower Content
Scroll position: 0px

![Scroll 67%](../screens/scroll/scroll-067.png)

### 83% — Near Footer
Scroll position: 0px

![Scroll 83%](../screens/scroll/scroll-083.png)

### 100% — Bottom / Footer
Scroll position: 0px

![Scroll 100%](../screens/scroll/scroll-100.png)

## CSS Keyframes (66 extracted)

### `@keyframes antSlideUpIn`

Used by: `.ant-slide-up-appear.ant-slide-up-appear-active, .ant-slide-up-enter.ant-slide-u`, `.ant-select-dropdown.ant-slide-up-appear.ant-slide-up-appear-active.ant-select-d`, `.ant-dropdown.ant-slide-down-appear.ant-slide-down-appear-active.ant-dropdown-pl`, `.ant-picker-dropdown.ant-slide-up-appear.ant-slide-up-appear-active.ant-picker-d`

```css
@keyframes antSlideUpIn {
  0% {
    transform: scaleY(0.8);
    transform-origin: 0px 0px;
    opacity: 0;
  }
  100% {
    transform: scaleY(1);
    transform-origin: 0px 0px;
    opacity: 1;
  }
}
```

> Fade + motion enter animation

### `@keyframes antSlideUpOut`

Used by: `.ant-slide-up-leave.ant-slide-up-leave-active`, `.ant-select-dropdown.ant-slide-up-leave.ant-slide-up-leave-active.ant-select-dro`, `.ant-dropdown.ant-slide-down-leave.ant-slide-down-leave-active.ant-dropdown-plac`, `.ant-picker-dropdown.ant-slide-up-leave.ant-slide-up-leave-active.ant-picker-dro`

```css
@keyframes antSlideUpOut {
  0% {
    transform: scaleY(1);
    transform-origin: 0px 0px;
    opacity: 1;
  }
  100% {
    transform: scaleY(0.8);
    transform-origin: 0px 0px;
    opacity: 0;
  }
}
```

> Fade + motion enter animation

### `@keyframes antSlideDownIn`

Used by: `.ant-slide-down-appear.ant-slide-down-appear-active, .ant-slide-down-enter.ant-s`, `.ant-select-dropdown.ant-slide-up-appear.ant-slide-up-appear-active.ant-select-d`, `.ant-dropdown.ant-slide-up-appear.ant-slide-up-appear-active.ant-dropdown-placem`, `.ant-picker-dropdown.ant-slide-up-appear.ant-slide-up-appear-active.ant-picker-d`

```css
@keyframes antSlideDownIn {
  0% {
    transform: scaleY(0.8);
    transform-origin: 100% 100%;
    opacity: 0;
  }
  100% {
    transform: scaleY(1);
    transform-origin: 100% 100%;
    opacity: 1;
  }
}
```

> Fade + motion enter animation

### `@keyframes antSlideDownOut`

Used by: `.ant-slide-down-leave.ant-slide-down-leave-active`, `.ant-select-dropdown.ant-slide-up-leave.ant-slide-up-leave-active.ant-select-dro`, `.ant-dropdown.ant-slide-up-leave.ant-slide-up-leave-active.ant-dropdown-placemen`, `.ant-picker-dropdown.ant-slide-up-leave.ant-slide-up-leave-active.ant-picker-dro`

```css
@keyframes antSlideDownOut {
  0% {
    transform: scaleY(1);
    transform-origin: 100% 100%;
    opacity: 1;
  }
  100% {
    transform: scaleY(0.8);
    transform-origin: 100% 100%;
    opacity: 0;
  }
}
```

> Fade + motion enter animation

### `@keyframes antCheckboxEffect`

Duration: `0.36s` · Easing: `ease-in-out` · Delay: `0s` · Iteration: `1` · Fill: `backwards`

Used by: `.ant-cascader-checkbox-checked::after`, `.ant-checkbox-checked::after`, `.ant-tree-checkbox-checked::after`, `.ant-select-tree-checkbox-checked::after`

```css
@keyframes antCheckboxEffect {
  0% {
    transform: scale(1);
    opacity: 0.5;
  }
  100% {
    transform: scale(1.6);
    opacity: 0;
  }
}
```

> Fade + motion enter animation

### `@keyframes loadingCircle`

Duration: `1s` · Easing: `linear` · Delay: `0s` · Iteration: `infinite` · Fill: `none`

Used by: `.anticon-spin::before, .anticon-spin`, `.anticon-spin, .anticon-spin::before`, `.ant-btn > .ant-btn-loading-icon .anticon svg`

```css
@keyframes loadingCircle {
  100% {
    transform: rotate(360deg);
  }
}
```

> Transform/motion animation

### `@keyframes loadingCircle`

Duration: `1s` · Easing: `linear` · Delay: `0s` · Iteration: `infinite` · Fill: `none`

Used by: `.anticon-spin::before, .anticon-spin`, `.anticon-spin, .anticon-spin::before`, `.ant-btn > .ant-btn-loading-icon .anticon svg`

```css
@keyframes loadingCircle {
  100% {
    transform: rotate(360deg);
  }
}
```

> Transform/motion animation

### `@keyframes loadingCircle`

Duration: `1s` · Easing: `linear` · Delay: `0s` · Iteration: `infinite` · Fill: `none`

Used by: `.anticon-spin::before, .anticon-spin`, `.anticon-spin, .anticon-spin::before`, `.ant-btn > .ant-btn-loading-icon .anticon svg`

```css
@keyframes loadingCircle {
  100% {
    transform: rotate(1turn);
  }
}
```

> Transform/motion animation

### `@keyframes antZoomBigIn`

Used by: `.ant-zoom-big-appear.ant-zoom-big-appear-active, .ant-zoom-big-enter.ant-zoom-bi`, `.ant-zoom-big-fast-appear.ant-zoom-big-fast-appear-active, .ant-zoom-big-fast-en`

```css
@keyframes antZoomBigIn {
  0% {
    transform: scale(0.8);
    opacity: 0;
  }
  100% {
    transform: scale(1);
    opacity: 1;
  }
}
```

> Fade + motion enter animation

### `@keyframes antZoomBigOut`

Used by: `.ant-zoom-big-leave.ant-zoom-big-leave-active`, `.ant-zoom-big-fast-leave.ant-zoom-big-fast-leave-active`

```css
@keyframes antZoomBigOut {
  0% {
    transform: scale(1);
  }
  100% {
    transform: scale(0.8);
    opacity: 0;
  }
}
```

> Fade + motion enter animation

### `@keyframes ant-tree-node-fx-do-not-use`

Duration: `0.3s` · Easing: `ease` · Delay: `0s` · Iteration: `1` · Fill: `forwards`

Used by: `.ant-tree.ant-tree-block-node .ant-tree-list-holder-inner .ant-tree-treenode.dra`, `.ant-select-tree.ant-select-tree-block-node .ant-select-tree-list-holder-inner .`

```css
@keyframes ant-tree-node-fx-do-not-use {
  0% {
    opacity: 0;
  }
  100% {
    opacity: 1;
  }
}
```

> Opacity fade

### `@keyframes antFadeIn`

Used by: `.ant-fade-appear.ant-fade-appear-active, .ant-fade-enter.ant-fade-enter-active`

```css
@keyframes antFadeIn {
  0% {
    opacity: 0;
  }
  100% {
    opacity: 1;
  }
}
```

> Opacity fade

### `@keyframes antFadeOut`

Used by: `.ant-fade-leave.ant-fade-leave-active`

```css
@keyframes antFadeOut {
  0% {
    opacity: 1;
  }
  100% {
    opacity: 0;
  }
}
```

> Opacity fade

### `@keyframes antMoveDownIn`

Used by: `.ant-move-down-appear.ant-move-down-appear-active, .ant-move-down-enter.ant-move`

```css
@keyframes antMoveDownIn {
  0% {
    transform: translateY(100%);
    transform-origin: 0px 0px;
    opacity: 0;
  }
  100% {
    transform: translateY(0px);
    transform-origin: 0px 0px;
    opacity: 1;
  }
}
```

> Fade + motion enter animation

### `@keyframes antMoveDownOut`

Used by: `.ant-move-down-leave.ant-move-down-leave-active`

```css
@keyframes antMoveDownOut {
  0% {
    transform: translateY(0px);
    transform-origin: 0px 0px;
    opacity: 1;
  }
  100% {
    transform: translateY(100%);
    transform-origin: 0px 0px;
    opacity: 0;
  }
}
```

> Fade + motion enter animation

### `@keyframes antMoveLeftIn`

Used by: `.ant-move-left-appear.ant-move-left-appear-active, .ant-move-left-enter.ant-move`

```css
@keyframes antMoveLeftIn {
  0% {
    transform: translateX(-100%);
    transform-origin: 0px 0px;
    opacity: 0;
  }
  100% {
    transform: translateX(0px);
    transform-origin: 0px 0px;
    opacity: 1;
  }
}
```

> Fade + motion enter animation

### `@keyframes antMoveLeftOut`

Used by: `.ant-move-left-leave.ant-move-left-leave-active`

```css
@keyframes antMoveLeftOut {
  0% {
    transform: translateX(0px);
    transform-origin: 0px 0px;
    opacity: 1;
  }
  100% {
    transform: translateX(-100%);
    transform-origin: 0px 0px;
    opacity: 0;
  }
}
```

> Fade + motion enter animation

### `@keyframes antMoveRightIn`

Used by: `.ant-move-right-appear.ant-move-right-appear-active, .ant-move-right-enter.ant-m`

```css
@keyframes antMoveRightIn {
  0% {
    transform: translateX(100%);
    transform-origin: 0px 0px;
    opacity: 0;
  }
  100% {
    transform: translateX(0px);
    transform-origin: 0px 0px;
    opacity: 1;
  }
}
```

> Fade + motion enter animation

### `@keyframes antMoveRightOut`

Used by: `.ant-move-right-leave.ant-move-right-leave-active`

```css
@keyframes antMoveRightOut {
  0% {
    transform: translateX(0px);
    transform-origin: 0px 0px;
    opacity: 1;
  }
  100% {
    transform: translateX(100%);
    transform-origin: 0px 0px;
    opacity: 0;
  }
}
```

> Fade + motion enter animation

### `@keyframes antMoveUpIn`

Used by: `.ant-move-up-appear.ant-move-up-appear-active, .ant-move-up-enter.ant-move-up-en`

```css
@keyframes antMoveUpIn {
  0% {
    transform: translateY(-100%);
    transform-origin: 0px 0px;
    opacity: 0;
  }
  100% {
    transform: translateY(0px);
    transform-origin: 0px 0px;
    opacity: 1;
  }
}
```

> Fade + motion enter animation

### `@keyframes antMoveUpOut`

Used by: `.ant-move-up-leave.ant-move-up-leave-active`

```css
@keyframes antMoveUpOut {
  0% {
    transform: translateY(0px);
    transform-origin: 0px 0px;
    opacity: 1;
  }
  100% {
    transform: translateY(-100%);
    transform-origin: 0px 0px;
    opacity: 0;
  }
}
```

> Fade + motion enter animation

### `@keyframes waveEffect`

Duration: `2s, 0.4s` · Easing: `cubic-bezier(0.08, 0.82, 0.17, 1), cubic-bezier(0.08, 0.82, 0.17, 1)` · Delay: `0s, 0s` · Iteration: `1, 1` · Fill: `forwards`

Used by: `.ant-click-animating-node, [ant-click-animating-without-extra-node="true"]::afte`

```css
@keyframes waveEffect {
  100% {
    box-shadow: 0 0 0 6px var(--antd-wave-shadow-color);
  }
}
```

> Shadow pulse/glow effect

### `@keyframes fadeEffect`

Duration: `2s, 0.4s` · Easing: `cubic-bezier(0.08, 0.82, 0.17, 1), cubic-bezier(0.08, 0.82, 0.17, 1)` · Delay: `0s, 0s` · Iteration: `1, 1` · Fill: `forwards`

Used by: `.ant-click-animating-node, [ant-click-animating-without-extra-node="true"]::afte`

```css
@keyframes fadeEffect {
  100% {
    opacity: 0;
  }
}
```

> Opacity fade

### `@keyframes antSlideLeftIn`

Used by: `.ant-slide-left-appear.ant-slide-left-appear-active, .ant-slide-left-enter.ant-s`

```css
@keyframes antSlideLeftIn {
  0% {
    transform: scaleX(0.8);
    transform-origin: 0px 0px;
    opacity: 0;
  }
  100% {
    transform: scaleX(1);
    transform-origin: 0px 0px;
    opacity: 1;
  }
}
```

> Fade + motion enter animation

### `@keyframes antSlideLeftOut`

Used by: `.ant-slide-left-leave.ant-slide-left-leave-active`

```css
@keyframes antSlideLeftOut {
  0% {
    transform: scaleX(1);
    transform-origin: 0px 0px;
    opacity: 1;
  }
  100% {
    transform: scaleX(0.8);
    transform-origin: 0px 0px;
    opacity: 0;
  }
}
```

> Fade + motion enter animation

### `@keyframes antSlideRightIn`

Used by: `.ant-slide-right-appear.ant-slide-right-appear-active, .ant-slide-right-enter.an`

```css
@keyframes antSlideRightIn {
  0% {
    transform: scaleX(0.8);
    transform-origin: 100% 0px;
    opacity: 0;
  }
  100% {
    transform: scaleX(1);
    transform-origin: 100% 0px;
    opacity: 1;
  }
}
```

> Fade + motion enter animation

### `@keyframes antSlideRightOut`

Used by: `.ant-slide-right-leave.ant-slide-right-leave-active`

```css
@keyframes antSlideRightOut {
  0% {
    transform: scaleX(1);
    transform-origin: 100% 0px;
    opacity: 1;
  }
  100% {
    transform: scaleX(0.8);
    transform-origin: 100% 0px;
    opacity: 0;
  }
}
```

> Fade + motion enter animation

### `@keyframes antZoomIn`

Used by: `.ant-zoom-appear.ant-zoom-appear-active, .ant-zoom-enter.ant-zoom-enter-active`

```css
@keyframes antZoomIn {
  0% {
    transform: scale(0.2);
    opacity: 0;
  }
  100% {
    transform: scale(1);
    opacity: 1;
  }
}
```

> Fade + motion enter animation

### `@keyframes antZoomOut`

Used by: `.ant-zoom-leave.ant-zoom-leave-active`

```css
@keyframes antZoomOut {
  0% {
    transform: scale(1);
  }
  100% {
    transform: scale(0.2);
    opacity: 0;
  }
}
```

> Fade + motion enter animation

### `@keyframes antZoomUpIn`

Used by: `.ant-zoom-up-appear.ant-zoom-up-appear-active, .ant-zoom-up-enter.ant-zoom-up-en`

```css
@keyframes antZoomUpIn {
  0% {
    transform: scale(0.8);
    transform-origin: 50% 0px;
    opacity: 0;
  }
  100% {
    transform: scale(1);
    transform-origin: 50% 0px;
  }
}
```

> Fade + motion enter animation

### `@keyframes antZoomUpOut`

Used by: `.ant-zoom-up-leave.ant-zoom-up-leave-active`

```css
@keyframes antZoomUpOut {
  0% {
    transform: scale(1);
    transform-origin: 50% 0px;
  }
  100% {
    transform: scale(0.8);
    transform-origin: 50% 0px;
    opacity: 0;
  }
}
```

> Fade + motion enter animation

### `@keyframes antZoomLeftIn`

Used by: `.ant-zoom-left-appear.ant-zoom-left-appear-active, .ant-zoom-left-enter.ant-zoom`

```css
@keyframes antZoomLeftIn {
  0% {
    transform: scale(0.8);
    transform-origin: 0px 50%;
    opacity: 0;
  }
  100% {
    transform: scale(1);
    transform-origin: 0px 50%;
  }
}
```

> Fade + motion enter animation

### `@keyframes antZoomLeftOut`

Used by: `.ant-zoom-left-leave.ant-zoom-left-leave-active`

```css
@keyframes antZoomLeftOut {
  0% {
    transform: scale(1);
    transform-origin: 0px 50%;
  }
  100% {
    transform: scale(0.8);
    transform-origin: 0px 50%;
    opacity: 0;
  }
}
```

> Fade + motion enter animation

### `@keyframes antZoomRightIn`

Used by: `.ant-zoom-right-appear.ant-zoom-right-appear-active, .ant-zoom-right-enter.ant-z`

```css
@keyframes antZoomRightIn {
  0% {
    transform: scale(0.8);
    transform-origin: 100% 50%;
    opacity: 0;
  }
  100% {
    transform: scale(1);
    transform-origin: 100% 50%;
  }
}
```

> Fade + motion enter animation

### `@keyframes antZoomRightOut`

Used by: `.ant-zoom-right-leave.ant-zoom-right-leave-active`

```css
@keyframes antZoomRightOut {
  0% {
    transform: scale(1);
    transform-origin: 100% 50%;
  }
  100% {
    transform: scale(0.8);
    transform-origin: 100% 50%;
    opacity: 0;
  }
}
```

> Fade + motion enter animation

### `@keyframes antZoomDownIn`

Used by: `.ant-zoom-down-appear.ant-zoom-down-appear-active, .ant-zoom-down-enter.ant-zoom`

```css
@keyframes antZoomDownIn {
  0% {
    transform: scale(0.8);
    transform-origin: 50% 100%;
    opacity: 0;
  }
  100% {
    transform: scale(1);
    transform-origin: 50% 100%;
  }
}
```

> Fade + motion enter animation

### `@keyframes antZoomDownOut`

Used by: `.ant-zoom-down-leave.ant-zoom-down-leave-active`

```css
@keyframes antZoomDownOut {
  0% {
    transform: scale(1);
    transform-origin: 50% 100%;
  }
  100% {
    transform: scale(0.8);
    transform-origin: 50% 100%;
    opacity: 0;
  }
}
```

> Fade + motion enter animation

### `@keyframes antStatusProcessing`

Duration: `1.2s` · Easing: `ease-in-out` · Delay: `0s` · Iteration: `infinite` · Fill: `none`

Used by: `.ant-badge-status-processing::after`

```css
@keyframes antStatusProcessing {
  0% {
    transform: scale(0.8);
    opacity: 0.5;
  }
  100% {
    transform: scale(2.4);
    opacity: 0;
  }
}
```

> Fade + motion enter animation

### `@keyframes antZoomBadgeIn`

Duration: `0.3s` · Easing: `cubic-bezier(0.12, 0.4, 0.29, 1.46)` · Delay: `0s` · Iteration: `1` · Fill: `both`

Used by: `.ant-badge-zoom-appear, .ant-badge-zoom-enter`

```css
@keyframes antZoomBadgeIn {
  0% {
    transform: scale(0) translate(50%, -50%);
    opacity: 0;
  }
  100% {
    transform: scale(1) translate(50%, -50%);
  }
}
```

> Fade + motion enter animation

### `@keyframes antZoomBadgeOut`

Duration: `0.3s` · Easing: `cubic-bezier(0.71, -0.46, 0.88, 0.6)` · Delay: `0s` · Iteration: `1` · Fill: `both`

Used by: `.ant-badge-zoom-leave`

```css
@keyframes antZoomBadgeOut {
  0% {
    transform: scale(1) translate(50%, -50%);
  }
  100% {
    transform: scale(0) translate(50%, -50%);
    opacity: 0;
  }
}
```

> Fade + motion enter animation

### `@keyframes antNoWrapperZoomBadgeIn`

Duration: `0.3s` · Easing: `cubic-bezier(0.12, 0.4, 0.29, 1.46)` · Delay: `0s` · Iteration: `1` · Fill: `none`

Used by: `.ant-badge-not-a-wrapper .ant-badge-zoom-appear, .ant-badge-not-a-wrapper .ant-b`

```css
@keyframes antNoWrapperZoomBadgeIn {
  0% {
    transform: scale(0);
    opacity: 0;
  }
  100% {
    transform: scale(1);
  }
}
```

> Fade + motion enter animation

### `@keyframes antNoWrapperZoomBadgeOut`

Duration: `0.3s` · Easing: `cubic-bezier(0.71, -0.46, 0.88, 0.6)` · Delay: `0s` · Iteration: `1` · Fill: `none`

Used by: `.ant-badge-not-a-wrapper .ant-badge-zoom-leave`

```css
@keyframes antNoWrapperZoomBadgeOut {
  0% {
    transform: scale(1);
  }
  100% {
    transform: scale(0);
    opacity: 0;
  }
}
```

> Fade + motion enter animation

### `@keyframes antBadgeLoadingCircle`

Duration: `1s` · Easing: `linear` · Delay: `0s` · Iteration: `infinite` · Fill: `none`

Used by: `.ant-badge .ant-scroll-number-custom-component.anticon-spin, .ant-badge-count.an`

```css
@keyframes antBadgeLoadingCircle {
  0% {
    transform-origin: 50% center;
  }
  100% {
    transform: translate(50%, -50%) rotate(1turn);
    transform-origin: 50% center;
  }
}
```

> Transform/motion animation

### `@keyframes antZoomBadgeInRtl`

Used by: `.ant-badge:not(.ant-badge-not-a-wrapper).ant-badge-rtl .ant-badge-zoom-appear, .`

```css
@keyframes antZoomBadgeInRtl {
  0% {
    transform: scale(0) translate(-50%, -50%);
    opacity: 0;
  }
  100% {
    transform: scale(1) translate(-50%, -50%);
  }
}
```

> Fade + motion enter animation

### `@keyframes antZoomBadgeOutRtl`

Used by: `.ant-badge:not(.ant-badge-not-a-wrapper).ant-badge-rtl .ant-badge-zoom-leave`

```css
@keyframes antZoomBadgeOutRtl {
  0% {
    transform: scale(1) translate(-50%, -50%);
  }
  100% {
    transform: scale(0) translate(-50%, -50%);
    opacity: 0;
  }
}
```

> Fade + motion enter animation

### `@keyframes antRadioEffect`

Duration: `0.36s` · Easing: `ease-in-out` · Delay: `0s` · Iteration: `1` · Fill: `both`

Used by: `.ant-radio-checked::after`

```css
@keyframes antRadioEffect {
  0% {
    transform: scale(1);
    opacity: 0.5;
  }
  100% {
    transform: scale(1.6);
    opacity: 0;
  }
}
```

> Fade + motion enter animation

### `@keyframes ant-skeleton-loading`

Duration: `1.4s` · Easing: `ease` · Delay: `0s` · Iteration: `infinite` · Fill: `none`

Used by: `.ant-skeleton-active .ant-skeleton-avatar::after, .ant-skeleton-active .ant-skel`

```css
@keyframes ant-skeleton-loading {
  0% {
    transform: translateX(-37.5%);
  }
  100% {
    transform: translateX(37.5%);
  }
}
```

> Transform/motion animation

### `@keyframes ant-skeleton-loading-rtl`

Used by: `.ant-skeleton-rtl.ant-skeleton.ant-skeleton-active .ant-skeleton-avatar, .ant-sk`

```css
@keyframes ant-skeleton-loading-rtl {
  0% {
    background-position-x: 0px;
    background-position-y: 50%;
  }
  100% {
    background-position-x: 100%;
    background-position-y: 50%;
  }
}
```

> Background color/gradient shift · Background position (shimmer/scroll)

### `@keyframes antdDrawerFadeIn`

Duration: `0.3s` · Easing: `cubic-bezier(0.23, 1, 0.32, 1)` · Delay: `0s` · Iteration: `1` · Fill: `none`

Used by: `.ant-drawer.ant-drawer-open .ant-drawer-mask`

```css
@keyframes antdDrawerFadeIn {
  0% {
    opacity: 0;
  }
  100% {
    opacity: 1;
  }
}
```

> Opacity fade

### `@keyframes antSpinMove`

Duration: `1s` · Easing: `linear` · Delay: `0s` · Iteration: `infinite` · Fill: `none`

Used by: `.ant-spin-dot-item`

```css
@keyframes antSpinMove {
  100% {
    opacity: 1;
  }
}
```

> Opacity fade

### `@keyframes antRotate`

Duration: `1.2s` · Easing: `linear` · Delay: `0s` · Iteration: `infinite` · Fill: `none`

Used by: `.ant-spin-dot-spin`

```css
@keyframes antRotate {
  100% {
    transform: rotate(1turn);
  }
}
```

> Transform/motion animation

### `@keyframes antRotateRtl`

Used by: `.ant-spin-rtl .ant-spin-dot-spin`

```css
@keyframes antRotateRtl {
  100% {
    transform: rotate(-405deg);
  }
}
```

> Transform/motion animation

### `@keyframes MessageMoveOut`

Duration: `0.3s`

Used by: `.ant-message-notice.ant-move-up-leave.ant-move-up-leave-active`

```css
@keyframes MessageMoveOut {
  0% {
    max-height: 150px;
    padding-top: 8px;
    padding-right: 8px;
    padding-bottom: 8px;
    padding-left: 8px;
    opacity: 1;
  }
  100% {
    max-height: 0px;
    padding-top: 0px;
    padding-right: 0px;
    padding-bottom: 0px;
    padding-left: 0px;
    opacity: 0;
  }
}
```

> Opacity fade · Dimension expand/collapse

### `@keyframes NotificationFadeIn`

Used by: `.ant-notification-fade-appear.ant-notification-fade-appear-active, .ant-notifica`

```css
@keyframes NotificationFadeIn {
  0% {
    left: 384px;
    opacity: 0;
  }
  100% {
    left: 0px;
    opacity: 1;
  }
}
```

> Opacity fade

### `@keyframes NotificationFadeOut`

Used by: `.ant-notification-fade-leave.ant-notification-fade-leave-active`

```css
@keyframes NotificationFadeOut {
  0% {
    max-height: 150px;
    margin-bottom: 16px;
    opacity: 1;
  }
  100% {
    max-height: 0px;
    margin-bottom: 0px;
    padding-top: 0px;
    padding-bottom: 0px;
    opacity: 0;
  }
}
```

> Opacity fade · Dimension expand/collapse

### `@keyframes NotificationTopFadeIn`

Used by: `.ant-notification-top .ant-notification-fade-appear.ant-notification-fade-appear`

```css
@keyframes NotificationTopFadeIn {
  0% {
    margin-top: -100%;
    opacity: 0;
  }
  100% {
    margin-top: 0px;
    opacity: 1;
  }
}
```

> Opacity fade

### `@keyframes NotificationBottomFadeIn`

Used by: `.ant-notification-bottom .ant-notification-fade-appear.ant-notification-fade-app`

```css
@keyframes NotificationBottomFadeIn {
  0% {
    margin-bottom: -100%;
    opacity: 0;
  }
  100% {
    margin-bottom: 0px;
    opacity: 1;
  }
}
```

> Opacity fade

### `@keyframes NotificationLeftFadeIn`

Used by: `.ant-notification-bottomLeft .ant-notification-fade-appear.ant-notification-fade`

```css
@keyframes NotificationLeftFadeIn {
  0% {
    right: 384px;
    opacity: 0;
  }
  100% {
    right: 0px;
    opacity: 1;
  }
}
```

> Opacity fade

### `@keyframes ant-progress-active`

Duration: `2.4s` · Easing: `cubic-bezier(0.23, 1, 0.32, 1)` · Delay: `0s` · Iteration: `infinite` · Fill: `none`

Used by: `.ant-progress-status-active .ant-progress-bg::before`

```css
@keyframes ant-progress-active {
  0% {
    transform: translateX(-100%) scaleX(0);
    opacity: 0.1;
  }
  20% {
    transform: translateX(-100%) scaleX(0);
    opacity: 0.5;
  }
  100% {
    transform: translateX(0px) scaleX(1);
    opacity: 0;
  }
}
```

> Fade + motion enter animation

### `@keyframes uploadAnimateInlineIn`

Used by: `.ant-upload-list .ant-upload-animate-inline-appear, .ant-upload-list .ant-upload`

```css
@keyframes uploadAnimateInlineIn {
  0% {
    width: 0px;
    height: 0px;
    margin-top: 0px;
    margin-right: 0px;
    margin-bottom: 0px;
    margin-left: 0px;
    padding-top: 0px;
    padding-right: 0px;
    padding-bottom: 0px;
    padding-left: 0px;
    opacity: 0;
  }
}
```

> Opacity fade · Dimension expand/collapse

### `@keyframes uploadAnimateInlineOut`

Used by: `.ant-upload-list .ant-upload-animate-inline-leave`

```css
@keyframes uploadAnimateInlineOut {
  100% {
    width: 0px;
    height: 0px;
    margin-top: 0px;
    margin-right: 0px;
    margin-bottom: 0px;
    margin-left: 0px;
    padding-top: 0px;
    padding-right: 0px;
    padding-bottom: 0px;
    padding-left: 0px;
    opacity: 0;
  }
}
```

> Opacity fade · Dimension expand/collapse

### `@keyframes nprogress-spinner`

Duration: `0.4s` · Easing: `linear` · Delay: `0s` · Iteration: `infinite` · Fill: `none`

Used by: `#nprogress .spinner-icon`

```css
@keyframes nprogress-spinner {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(1turn);
  }
}
```

> Transform/motion animation

### `@keyframes react-loading-skeleton`

Duration: `var(--animation-duration)` · Easing: `ease-in-out` · Iteration: `infinite`

Used by: `.react-loading-skeleton::after`

```css
@keyframes react-loading-skeleton {
  100% {
    transform: translateX(100%);
  }
}
```

> Transform/motion animation

### `@keyframes diffZoomIn1`

```css
@keyframes diffZoomIn1 {
  0% {
    transform: scale(0);
    opacity: 0;
  }
  100% {
    transform: scale(1);
    opacity: 1;
  }
}
```

> Fade + motion enter animation

### `@keyframes diffZoomIn2`

```css
@keyframes diffZoomIn2 {
  0% {
    transform: scale(0);
    opacity: 0;
  }
  100% {
    transform: scale(1);
    opacity: 1;
  }
}
```

> Fade + motion enter animation

### `@keyframes diffZoomIn3`

```css
@keyframes diffZoomIn3 {
  0% {
    transform: scale(0);
    opacity: 0;
  }
  100% {
    transform: scale(1);
    opacity: 1;
  }
}
```

> Fade + motion enter animation

## Global Transition Declarations

These `transition` values were extracted from CSS rules across the site:

```css
transition: color 0.3s;
transition: height 0.2s cubic-bezier(0.645, 0.045, 0.355, 1), opacity 0.2s cubic-bezier(0.645, 0.045, 0.355, 1);
transition: max-height 0.3s cubic-bezier(0.78, 0.14, 0.15, 0.86), opacity 0.3s cubic-bezier(0.78, 0.14, 0.15, 0.86), padding-top 0.3s cubic-bezier(0.78, 0.14, 0.15, 0.86), padding-bottom 0.3s cubic-bezier(0.78, 0.14, 0.15, 0.86), margin-bottom 0.3s cubic-bezier(0.78, 0.14, 0.15, 0.86);
transition: top 0.3s ease-in-out;
transition: 0.3s;
transition: font-size 0.3s, line-height 0.3s, height 0.3s;
transition: 0.3s cubic-bezier(0.645, 0.045, 0.355, 1);
transition: transform 0.3s;
transition: color 0.3s, opacity 0.15s;
transition: background 0.3s;
transition: background 1.5s;
transition: transform 0.2s;
```

## How to Recreate This Motion Design

### Step 2 — Scroll-Reveal Pattern

Elements that animate into view follow this pattern:

```css
/* Initial hidden state */
.reveal {
  opacity: 0;
  transform: translateY(40px);
  transition: opacity 0.3s cubic-bezier(0.4, 0, 0.2, 1),
              transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}
.reveal.visible {
  opacity: 1;
  transform: translateY(0);
}
```

### Step 3 — Key Motion Principles

- **Duration scale:** `0.3s` · `0.2s` — use these values, never invent new durations
- **Always add** `@media (prefers-reduced-motion: reduce) { * { animation-duration: 0.01ms !important; transition-duration: 0.01ms !important; } }`

### Step 4 — Scroll Journey Reference

Match what happens at each scroll position:

- **0%** (`0px`) → `screens/scroll/scroll-000.png`
- **17%** (`0px`) → `screens/scroll/scroll-017.png`
- **33%** (`0px`) → `screens/scroll/scroll-033.png`
- **50%** (`0px`) → `screens/scroll/scroll-050.png`
- **67%** (`0px`) → `screens/scroll/scroll-067.png`
- **83%** (`0px`) → `screens/scroll/scroll-083.png`
- **100%** (`0px`) → `screens/scroll/scroll-100.png`

