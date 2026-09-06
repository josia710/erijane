<?php

/**
 * Seed-only site chrome defaults (fallback if SiteSetting rows missing).
 */
return [
    'nav' => [
        ['label' => 'My Fitness Journey', 'route' => 'login'],
        ['label' => 'Workout Programs', 'route' => 'programs'],
        ['label' => 'Workout Videos', 'route' => 'videos'],
        ['label' => 'Recipes', 'route' => 'recipes'],
        ['label' => 'Community', 'route' => 'community'],
        ['label' => 'Store', 'route' => 'store'],
        ['label' => 'About', 'route' => 'about'],
    ],

    'assets' => [
        'app_icon' => 'images/erijane/icon-112.png',
        'google' => 'images/chloe/ui/google.png',
        'apple' => 'images/chloe/ui/apple.41ee0a1b.png',
        'hero_bg' => 'images/chloe/ui/homepage-background-2025.png',
        'banner' => 'images/chloe/hero/chloeting-banner.e2207dc5.png',
        'track_kcal_out' => 'images/chloe/hero/track-kcal-out.0355d0bf.png',
        'track_kcal_in' => 'images/chloe/hero/track-kcal-in.7144c4b6.png',
        'monitor' => 'images/chloe/hero/monitor.d3c8005f.png',
        'organize' => 'images/chloe/hero/organize.039755f5.png',
        'train' => 'images/chloe/hero/train.ff560bfb.png',
        'connect' => 'images/chloe/hero/connect.44ddc83d.png',
        'performance' => 'images/chloe/hero/performance-audit.a8d696be.png',
        'about_header' => 'images/chloe/hero/erijane-about-header.png',
        'about_close' => 'images/chloe/hero/erijane-about-close.png',
    ],

    'community_features' => [
        ['title' => 'Personal daily workout schedule', 'body' => 'Customize and easily track your workouts every day.'],
        ['title' => 'Complete challenges as a team', 'body' => 'Join a team to motivate one another.'],
        ['title' => 'Track your progress visually', 'body' => 'Add photos and create collages to track progress.'],
        ['title' => 'Set customizable reminders', 'body' => 'Never miss your daily workout.'],
        ['title' => 'Save favorite recipes', 'body' => 'Organize meals that fuel your training.'],
        ['title' => 'Earn achievements', 'body' => 'Gain titles for milestones and activity.'],
    ],

    'socials' => [
        ['label' => 'Facebook', 'icon' => 'facebook', 'href' => 'https://www.facebook.com/itschloeting'],
        ['label' => 'Instagram', 'icon' => 'instagram', 'href' => 'https://www.instagram.com/chloe_t/'],
        ['label' => 'Twitter', 'icon' => 'twitter', 'href' => 'https://twitter.com/chloe_ting'],
        ['label' => 'Discord', 'icon' => 'discord', 'href' => 'https://discord.gg/chloeting'],
        ['label' => 'YouTube', 'icon' => 'youtube', 'href' => 'https://www.youtube.com/channel/UCCgLoMYIyP0U56dEhEL1wXQ'],
    ],
];
