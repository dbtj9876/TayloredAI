<?php
/*
Template Name: Service - Optimization
*/
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ongoing Optimization | Taylored AI</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: { dark: '#020617', card: '#0F172A', primary: '#3b82f6', cyan: '#06b6d4', green: '#10b981' }
                    },
                    fontFamily: { sans: ['Plus Jakarta Sans', 'sans-serif'] }
                }
            }
        }
    </script>
    <style>
        body { background-color: #020617; color: white; }
        .glass-panel { background: rgba(15, 23, 42, 0.6); backdrop-filter: blur(12px); border: 1px solid rgba(255, 255, 255, 0.05); }
        .text-gradient { background: linear-gradient(to right, #3b82f6, #06b6d4, #10b981); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        .bg-grid { background-size: 50px 50px; background-image: linear-gradient(to right, rgba(255, 255, 255, 0.03) 1px, transparent 1px), linear-gradient(to bottom, rgba(255, 255, 255, 0.03) 1px, transparent 1px); }
    </style>
    <?php wp_head(); ?>
</head>
<body class="antialiased">
    <nav class="fixed w-full z-50 top-0 glass-panel border-b border-white/5">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <a href="/" class="flex items-center gap-3">
                <img src="TayloredAI Logo.png" alt="Taylored AI Logo" class="h-10 w-auto" />
                <span class="text-xl font-bold">Taylored AI</span>
            </a>
            <a href="/" class="text-gray-300 hover:text-brand-cyan transition-colors">← Back to Home</a>
        </div>
    </nav>

    <header class="relative pt-32 pb-16 px-6 overflow-hidden">
        <div class="absolute inset-0 bg-grid opacity-50"></div>
        <div class="absolute top-0 right-0 w-96 h-96 bg-purple-500/10 rounded-full blur-[120px]"></div>
        
        <div class="max-w-4xl mx-auto relative z-10">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full border border-purple-500/30 bg-purple-500/10 mb-6">
                <span class="w-2 h-2 rounded-full bg-purple-400 animate-pulse"></span>
                <span class="text-xs font-medium text-brand-cyan uppercase tracking-wide">Service</span>
            </div>
            <h1 class="text-4xl md:text-6xl font-bold mb-6"><span class="text-gradient">Ongoing Optimization</span></h1>
            <p class="text-2xl md:text-3xl text-gray-300 font-light">AI Isn't "Set and Forget."</p>
        </div>
    </header>

    <main class="max-w-4xl mx-auto px-6 pb-24">
        <div class="glass-panel rounded-2xl p-8 md:p-12">
            <p class="text-lg text-gray-300 leading-relaxed mb-8">"Models drift. Data patterns change. Competitors evolve. Deploying an AI solution is just Day 1. We provide continuous monitoring, fine-tuning, and optimization to ensure your AI assets remain performant, cost-effective, and aligned with business goals over time."</p>

            <h2 class="text-2xl font-bold mb-6 text-brand-cyan">What We Do</h2>
            <ul class="space-y-4 mb-12">
                <li class="flex gap-4">
                    <div class="w-8 h-8 rounded-lg bg-purple-500/20 flex items-center justify-center flex-shrink-0 mt-1"><span class="text-purple-400 font-bold">1</span></div>
                    <div><h3 class="font-semibold text-white mb-1">Performance Monitoring</h3><p class="text-gray-400">Tracking accuracy, latency, and token usage costs in real-time.</p></div>
                </li>
                <li class="flex gap-4">
                    <div class="w-8 h-8 rounded-lg bg-brand-cyan/20 flex items-center justify-center flex-shrink-0 mt-1"><span class="text-brand-cyan font-bold">2</span></div>
                    <div><h3 class="font-semibold text-white mb-1">Model Fine-Tuning</h3><p class="text-gray-400">Retraining models on your latest proprietary data to improve relevance.</p></div>
                </li>
                <li class="flex gap-4">
                    <div class="w-8 h-8 rounded-lg bg-brand-green/20 flex items-center justify-center flex-shrink-0 mt-1"><span class="text-brand-green font-bold">3</span></div>
                    <div><h3 class="font-semibold text-white mb-1">Cost Optimization</h3><p class="text-gray-400">Optimizing prompt engineering and model selection to reduce API bills without sacrificing quality.</p></div>
                </li>
                <li class="flex gap-4">
                    <div class="w-8 h-8 rounded-lg bg-brand-primary/20 flex items-center justify-center flex-shrink-0 mt-1"><span class="text-brand-primary font-bold">4</span></div>
                    <div><h3 class="font-semibold text-white mb-1">Safety Guardrails</h3><p class="text-gray-400">Regularly updating content filters to prevent hallucinations and bias.</p></div>
                </li>
            </ul>

            <h2 class="text-2xl font-bold mb-6 text-brand-green">Service Models</h2>
            <div class="grid md:grid-cols-2 gap-6">
                <div class="glass-panel p-6 rounded-xl border border-brand-cyan/20">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="text-3xl">📅</div>
                        <h3 class="font-semibold text-white">Monthly Retainer</h3>
                    </div>
                    <p class="text-gray-400 text-sm">Continuous monitoring, weekly reports, and on-demand adjustments for active AI systems.</p>
                </div>
                <div class="glass-panel p-6 rounded-xl border border-brand-green/20">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="text-3xl">🔍</div>
                        <h3 class="font-semibold text-white">Quarterly Health Checks</h3>
                    </div>
                    <p class="text-gray-400 text-sm">Deep-dive audits every 90 days with actionable recommendations and ROI analysis.</p>
                </div>
            </div>
        </div>

        <div class="mt-12 text-center">
            <a href="/#contact" class="inline-flex items-center gap-2 px-8 py-4 bg-gradient-to-r from-purple-500 to-brand-cyan rounded-lg font-semibold text-white hover:shadow-[0_0_30px_rgba(168,85,247,0.4)] transition-all">Keep Your AI Sharp →</a>
        </div>
    </main>
    <?php wp_footer(); ?>
</body>
</html>
