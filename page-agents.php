<?php
/*
Template Name: Service - Agents
*/
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AI Agents & Automation | Taylored AI</title>
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
                <img src="/TayloredAI Logo.png" alt="Taylored AI Logo" class="h-10 w-auto" />
                <span class="text-xl font-bold">Taylored AI</span>
            </a>
            <a href="/" class="text-gray-300 hover:text-brand-cyan transition-colors">← Back to Home</a>
        </div>
    </nav>

    <header class="relative pt-32 pb-16 px-6 overflow-hidden">
        <div class="absolute inset-0 bg-grid opacity-50"></div>
        <div class="absolute top-0 right-0 w-96 h-96 bg-brand-cyan/10 rounded-full blur-[120px]"></div>
        
        <div class="max-w-4xl mx-auto relative z-10">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full border border-brand-cyan/30 bg-brand-cyan/10 mb-6">
                <span class="w-2 h-2 rounded-full bg-brand-cyan animate-pulse"></span>
                <span class="text-xs font-medium text-brand-cyan uppercase tracking-wide">Service</span>
            </div>
            <h1 class="text-4xl md:text-6xl font-bold mb-6"><span class="text-gradient">AI Agents & Automation</span></h1>
            <p class="text-2xl md:text-3xl text-gray-300 font-light">The Workforce of the Future is Hybrid.</p>
        </div>
    </header>

    <main class="max-w-4xl mx-auto px-6 pb-24">
        <div class="glass-panel rounded-2xl p-8 md:p-12">
            <p class="text-lg text-gray-300 leading-relaxed mb-8">"Move beyond simple chatbots. We build autonomous AI agents capable of reasoning, planning, and executing complex tasks. From handling invoice discrepancies to triaging customer support tickets, our agents work alongside your team to eliminate drudgery."</p>

            <h2 class="text-2xl font-bold mb-6 text-brand-cyan">What We Do</h2>
            <ul class="space-y-4 mb-12">
                <li class="flex gap-4">
                    <div class="w-8 h-8 rounded-lg bg-brand-cyan/20 flex items-center justify-center flex-shrink-0 mt-1"><span class="text-brand-cyan font-bold">1</span></div>
                    <div><h3 class="font-semibold text-white mb-1">Workflow Automation</h3><p class="text-gray-400">Deploying agents to handle repetitive, multi-step processes across email, CRM, and ERP systems.</p></div>
                </li>
                <li class="flex gap-4">
                    <div class="w-8 h-8 rounded-lg bg-brand-primary/20 flex items-center justify-center flex-shrink-0 mt-1"><span class="text-brand-primary font-bold">2</span></div>
                    <div><h3 class="font-semibold text-white mb-1">Intelligent Retrieval (RAG)</h3><p class="text-gray-400">Building internal search engines that allow employees to "chat" with your company's knowledge base.</p></div>
                </li>
                <li class="flex gap-4">
                    <div class="w-8 h-8 rounded-lg bg-brand-green/20 flex items-center justify-center flex-shrink-0 mt-1"><span class="text-brand-green font-bold">3</span></div>
                    <div><h3 class="font-semibold text-white mb-1">Custom Agent Development</h3><p class="text-gray-400">Using frameworks like LangChain and AutoGen to create bespoke digital workers.</p></div>
                </li>
            </ul>

            <h2 class="text-2xl font-bold mb-6 text-brand-green">Use Cases</h2>
            <div class="grid md:grid-cols-3 gap-4 mb-12">
                <div class="glass-panel p-6 rounded-xl">
                    <div class="text-2xl mb-3">💰</div>
                    <h3 class="font-semibold text-white mb-2">Finance</h3>
                    <p class="text-sm text-gray-400">Automated invoice processing and reconciliation.</p>
                </div>
                <div class="glass-panel p-6 rounded-xl">
                    <div class="text-2xl mb-3">🎧</div>
                    <h3 class="font-semibold text-white mb-2">Support</h3>
                    <p class="text-sm text-gray-400">L1/L2 ticket triage and auto-resolution.</p>
                </div>
                <div class="glass-panel p-6 rounded-xl">
                    <div class="text-2xl mb-3">👥</div>
                    <h3 class="font-semibold text-white mb-2">HR</h3>
                    <p class="text-sm text-gray-400">Automated candidate screening and onboarding scheduling.</p>
                </div>
            </div>

            <div class="glass-panel p-6 rounded-xl border border-brand-cyan/30 bg-brand-cyan/5">
                <p class="text-center text-gray-300 italic">"Demo: Ask us to see an agent in action."</p>
            </div>
        </div>

        <div class="mt-12 text-center">
            <a href="/#contact" class="inline-flex items-center gap-2 px-8 py-4 bg-gradient-to-r from-brand-cyan to-brand-green rounded-lg font-semibold text-white hover:shadow-[0_0_30px_rgba(6,182,212,0.4)] transition-all">Build Your First Agent →</a>
        </div>
    </main>
    <?php wp_footer(); ?>
</body>
</html>
