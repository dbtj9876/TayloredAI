<?php
/*
Template Name: Taylored AI Home
*/
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Taylored AI | Enterprise Intelligence</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700&display=swap"
        rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            dark: '#020617', // Midnight Navy
                            card: '#0F172A', // Lighter Navy
                            primary: '#3b82f6', // Logo Blue
                            cyan: '#06b6d4', // Logo Cyan
                            green: '#10b981', // Logo Green
                        }
                    },
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                    },
                    animation: {
                        'float': 'float 6s ease-in-out infinite',
                        'pulse-slow': 'pulse 8s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                        'beam': 'beam 10s linear infinite',
                        'shimmer': 'shimmer 2s linear infinite',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-20px)' },
                        },
                        beam: {
                            '0%': { transform: 'translateX(-100%) rotate(45deg)' },
                            '100%': { transform: 'translateX(200%) rotate(45deg)' },
                        },
                        shimmer: {
                            'from': { backgroundPosition: '0 0' },
                            'to': { backgroundPosition: '-200% 0' },
                        }
                    }
                }
            }
        }
    </script>
    <style>
        /* Custom Utilities for Glass & Glow */
        body {
            background-color: #020617;
            color: white;
            overflow-x: hidden;
        }

        .glass-panel {
            background: rgba(15, 23, 42, 0.6);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.05);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        }

        /* Grid Background Pattern */
        .bg-grid {
            background-size: 50px 50px;
            background-image: linear-gradient(to right, rgba(255, 255, 255, 0.03) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(255, 255, 255, 0.03) 1px, transparent 1px);
            mask-image: linear-gradient(to bottom, transparent, black, transparent);
            -webkit-mask-image: linear-gradient(to bottom, transparent 5%, black 40%, black 70%, transparent 95%);
        }

        /* Text Gradient based on Logo */
        .text-gradient {
            background: linear-gradient(to right, #3b82f6, #06b6d4, #10b981);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* Hover Card Glow */
        .service-card {
            transition: all 0.4s ease;
        }

        .service-card:hover {
            transform: translateY(-8px) scale(1.02);
            border-color: rgba(6, 182, 212, 0.3);
            box-shadow: 0 0 30px rgba(6, 182, 212, 0.15);
        }

        /* Reveal on Scroll Class */
        .reveal {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s ease-out;
        }

        .reveal.active {
            opacity: 1;
            transform: translateY(0);
        }

        /* Ghosted Logo Fade Mask */
        .mask-radial-fade {
            mask-image: radial-gradient(circle, black 30%, transparent 70%);
            -webkit-mask-image: radial-gradient(circle, black 30%, transparent 70%);
        }
    </style>
    <?php wp_head(); ?>
</head>

<body class="antialiased selection:bg-brand-cyan selection:text-black">

    <!-- NAVIGATION -->
    <nav class="fixed w-full z-50 top-0 transition-all duration-300 glass-panel border-b-0">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center gap-3">
                <!-- LOGO IMAGE HERE -->
                <img src="TayloredAI Logo.png" alt="Taylored AI Logo" class="h-14 w-auto object-contain" />
                <span class="text-xl font-bold tracking-tight">Taylored AI</span>
            </div>
            <div class="hidden md:flex space-x-8 text-sm font-medium text-gray-300">
                <a href="#services" class="hover:text-brand-cyan transition-colors">Services</a>
                <a href="#approach" class="hover:text-brand-cyan transition-colors">Methodology</a>
                <a href="#about" class="hover:text-brand-cyan transition-colors">About</a>
            </div>
            <a href="#contact"
                class="px-5 py-2 rounded-full text-sm font-semibold bg-white text-black hover:bg-brand-cyan hover:text-white transition-all duration-300 shadow-[0_0_15px_rgba(255,255,255,0.3)] hover:shadow-[0_0_20px_rgba(6,182,212,0.6)]">
                Get Started
            </a>
        </div>
    </nav>

    <!-- HERO SECTION -->
    <header class="relative min-h-screen flex items-center justify-center overflow-hidden pt-20">

        <!-- === GHOSTED BACKGROUND LOGO === -->
        <!-- This sits behind everything with low opacity -->
        <div class="absolute inset-0 flex items-center justify-end z-0 pointer-events-none overflow-hidden">
            <img src="TayloredAI Logo.png" alt=""
                class="w-[600px] h-auto opacity-[0.43] object-contain mask-radial-fade" />
        </div>

        <!-- Ambient Background Effects -->
        <div class="absolute inset-0 bg-grid z-0 pointer-events-none"></div>
        <div class="absolute top-1/4 left-1/4 w-86 h-86 bg-brand-primary/20 rounded-full blur-[100px] ">
        </div>
        <div class="absolute bottom-1/4 right-1/4 w-86 h-86 bg-brand-green/20 rounded-full blur-[100px] "
            style="animation-delay: 2s"></div>

        <div class="relative z-10 max-w-5xl mx-auto px-6 text-center">
            <div
                class="inline-flex items-center gap-2 px-3 py-1 rounded-full border border-white/10 bg-white/5 backdrop-blur-sm mb-8 animate-float">
                <span class="w-2 h-2 rounded-full bg-brand-green animate-pulse"></span>
                <span class="text-xs font-medium text-brand-cyan tracking-wide uppercase">AI Consulting &
                    Strategy</span>
            </div>

            <h1 class="text-5xl md:text-7xl font-bold tracking-tight leading-[1.1] mb-6">
                Tailoring Intelligence <br />
                <span class="text-gradient">For Your Business.</span>
            </h1>

            <p class="text-lg md:text-xl text-gray-400 max-w-2xl mx-auto mb-10 leading-relaxed">
                We decode the complexity of Artificial Intelligence to build custom adoption roadmaps, automated agents,
                and data infrastructure that scales with you.
            </p>

            <div class="flex flex-col md:flex-row items-center justify-center gap-4">
                <button
                    class="group relative px-8 py-4 bg-brand-primary rounded-lg font-semibold overflow-hidden transition-all hover:scale-105">
                    <div
                        class="absolute inset-0 w-full h-full bg-gradient-to-r from-transparent via-white/20 to-transparent -translate-x-full group-hover:animate-[shimmer_1.5s_infinite]">
                    </div>
                    <span class="relative text-white">Start Your Transformation</span>
                </button>
                <button
                    class="px-8 py-4 rounded-lg font-semibold border border-white/20 hover:border-brand-cyan hover:text-brand-cyan transition-all">
                    View Solutions
                </button>
            </div>
        </div>

        <!-- Abstract Beam/Particle visual at bottom -->
        <div class="absolute bottom-0 w-full h-32 bg-gradient-to-t from-brand-dark to-transparent z-20"></div>
    </header>

    <!-- SERVICES SECTION -->
    <section id="services" class="relative py-24 px-6">
        <div class="max-w-7xl mx-auto">
            <div class="mb-16 reveal">
                <h2 class="text-3xl md:text-5xl font-bold mb-4">Core Capabilities</h2>
                <div class="h-1 w-20 bg-gradient-to-r from-brand-primary to-brand-green rounded-full"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                <!-- Service 1 -->
                <div
                    class="service-card glass-panel p-8 rounded-2xl reveal group cursor-default relative overflow-hidden">
                    <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                        <svg class="w-24 h-24 text-brand-primary" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12 2L2 7l10 5 10-5-10-5zm0 9l2.5-1.25L12 8.5l-2.5 1.25L12 11zm0 2.5l-5-2.5-5 2.5L12 22l10-8.5-5-2.5-5 2.5z" />
                        </svg>
                    </div>
                    <div
                        class="w-12 h-12 rounded-lg bg-brand-primary/20 flex items-center justify-center mb-6 text-brand-primary group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                            </path>
                        </svg>
                    </div>
                    <!-- CHANGED: Added group-hover:text-brand-green -->
                    <h3 class="text-xl font-bold mb-3 text-white transition-colors group-hover:text-brand-green">AI
                        Transformation & Roadmaps</h3>
                    <p class="text-gray-400 text-sm leading-relaxed">
                        Assess workflows and identify high-impact opportunities. We align stakeholders and build the
                        strategic bridge between where you are and an AI-first future.
                    </p>
                </div>

                <!-- Service 2 -->
                <div class="service-card glass-panel p-8 rounded-2xl reveal group cursor-default relative overflow-hidden"
                    style="transition-delay: 100ms">
                    <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                        <svg class="w-24 h-24 text-brand-green" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm0 10.99h7c-.53 4.12-3.28 7.79-7 8.94V12H5V6.3l7-3.11v8.8z" />
                        </svg>
                    </div>
                    <div
                        class="w-12 h-12 rounded-lg bg-brand-green/20 flex items-center justify-center mb-6 text-brand-green group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <!-- CHANGED: Added group-hover:text-brand-green -->
                    <h3 class="text-xl font-bold mb-3 text-white transition-colors group-hover:text-brand-green">Data
                        Readiness & AI Audits</h3>
                    <p class="text-gray-400 text-sm leading-relaxed">
                        AI is only as good as the data it feeds on. We evaluate your infrastructure, governance, and
                        compliance to ensure a rock-solid foundation.
                    </p>
                </div>

                <!-- Service 3 (Featured) -->
                <div class="service-card glass-panel p-8 rounded-2xl reveal group cursor-default relative overflow-hidden border-brand-cyan/30"
                    style="transition-delay: 200ms">
                    <div
                        class="absolute inset-0 bg-gradient-to-br from-brand-cyan/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity">
                    </div>
                    <div
                        class="w-12 h-12 rounded-lg bg-brand-cyan/20 flex items-center justify-center mb-6 text-brand-cyan group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z">
                            </path>
                        </svg>
                    </div>
                    <!-- CHANGED: Added group-hover:text-brand-green -->
                    <h3 class="text-xl font-bold mb-3 text-white transition-colors group-hover:text-brand-green">AI
                        Agents & Automation</h3>
                    <p class="text-gray-400 text-sm leading-relaxed">
                        Deploy intelligent agents that handle invoicing, scheduling, and support. We integrate these
                        seamlessly into your CRM and finance tools.
                    </p>
                </div>

                <!-- Service 4 -->
                <div class="service-card glass-panel p-8 rounded-2xl reveal group cursor-default relative overflow-hidden"
                    style="transition-delay: 300ms">
                    <div
                        class="w-12 h-12 rounded-lg bg-purple-500/20 flex items-center justify-center mb-6 text-purple-400 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <!-- CHANGED: Added group-hover:text-brand-green -->
                    <h3 class="text-xl font-bold mb-3 text-white transition-colors group-hover:text-brand-green">Ongoing
                        Optimization</h3>
                    <p class="text-gray-400 text-sm leading-relaxed">
                        AI isn't "set and forget." We provide continuous monitoring and model fine-tuning to ensure your
                        ROI grows over time.
                    </p>
                </div>

                <!-- Service 5 -->
                <div class="service-card glass-panel p-8 rounded-2xl reveal group cursor-default relative overflow-hidden md:col-span-2 lg:col-span-2"
                    style="transition-delay: 400ms">
                    <div
                        class="w-12 h-12 rounded-lg bg-orange-500/20 flex items-center justify-center mb-6 text-orange-400 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                            </path>
                        </svg>
                    </div>
                    <!-- CHANGED: Added group-hover:text-brand-green -->
                    <h3 class="text-xl font-bold mb-3 text-white transition-colors group-hover:text-brand-green">Change
                        Management & Training</h3>
                    <p class="text-gray-400 text-sm leading-relaxed max-w-xl">
                        Technology fails without adoption. We deliver hands-on training and cultural adoption programs
                        so your teams don't just use the tools—they embrace them.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- CALL TO ACTION -->
    <section class="relative py-24 px-6 overflow-hidden">
        <div class="absolute inset-0 bg-brand-primary/10 skew-y-3 transform origin-bottom-right"></div>
        <div
            class="max-w-4xl mx-auto text-center relative z-10 glass-panel rounded-3xl p-12 border border-brand-cyan/20 reveal">
            <h2 class="text-3xl md:text-5xl font-bold mb-6">Ready to Future-Proof Your Business?</h2>
            <p class="text-gray-300 mb-8 text-lg">Let's audit your current infrastructure and identify your
                highest-value AI opportunities.</p>
            <form class="max-w-md mx-auto flex gap-2">
                <input type="email" placeholder="Enter your email"
                    class="flex-1 bg-black/40 border border-gray-700 rounded-lg px-4 py-3 text-white focus:outline-none focus:border-brand-cyan transition-colors">
                <button
                    class="bg-gradient-to-r from-brand-primary to-brand-cyan text-white px-6 py-3 rounded-lg font-bold hover:shadow-[0_0_20px_rgba(59,130,246,0.5)] transition-shadow">
                    Book Consult
                </button>
            </form>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="bg-black py-12 border-t border-gray-800 text-sm">
        <div
            class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row justify-between items-center opacity-60 hover:opacity-100 transition-opacity">
            <div class="flex items-center gap-2 mb-4 md:mb-0">
                <div class="w-6 h-6 rounded-full bg-gray-700"></div>
                <span class="font-bold">Taylored AI</span>
            </div>
            <div class="flex gap-8 text-gray-400">
                <a href="#" class="hover:text-white">Privacy</a>
                <a href="#" class="hover:text-white">Terms</a>
                <a href="#" class="hover:text-white">LinkedIn</a>
            </div>
            <div class="text-gray-500 mt-4 md:mt-0">
                &copy; 2024 Taylored AI. All rights reserved.
            </div>
        </div>
    </footer>

    <!-- INTERACTION SCRIPTS -->
    <script>
        // Progressive Reveal on Scroll
        function reveal() {
            var reveals = document.querySelectorAll(".reveal");
            for (var i = 0; i < reveals.length; i++) {
                var windowHeight = window.innerHeight;
                var elementTop = reveals[i].getBoundingClientRect().top;
                var elementVisible = 150;
                if (elementTop < windowHeight - elementVisible) {
                    reveals[i].classList.add("active");
                }
            }
        }
        window.addEventListener("scroll", reveal);
        // Trigger once on load
        reveal();
    </script>
    <?php wp_footer(); ?>
</body>

</html>