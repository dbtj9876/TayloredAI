<?php
/*
Template Name: Service Detail Page
*/
get_header(); // We'll need to create a header.php or just include the head logic here if we are lazy, but let's do it right-ish.
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php the_title(); ?> | Taylored AI</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            dark: '#020617',
                            card: '#0F172A',
                            primary: '#3b82f6',
                            cyan: '#06b6d4',
                            green: '#10b981',
                        }
                    },
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        body { background-color: #020617; color: white; }
        .glass-panel {
            background: rgba(15, 23, 42, 0.6);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }
    </style>
    <?php wp_head(); ?>
</head>
<body class="antialiased">

    <!-- NAV -->
    <nav class="fixed w-full z-50 top-0 glass-panel border-b border-white/10">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <a href="<?php echo home_url(); ?>" class="flex items-center gap-3">
                <span class="text-xl font-bold tracking-tight">Taylored AI</span>
            </a>
            <div class="hidden md:flex space-x-8 text-sm font-medium text-gray-300">
                <a href="<?php echo home_url(); ?>#services" class="hover:text-brand-cyan transition-colors">Back to Services</a>
                <a href="<?php echo home_url(); ?>/blog" class="hover:text-brand-cyan transition-colors">Blog</a>
            </div>
        </div>
    </nav>

    <!-- CONTENT -->
    <article class="pt-32 pb-24 px-6">
        <div class="max-w-4xl mx-auto">
            <header class="mb-12 text-center">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full border border-white/10 bg-white/5 backdrop-blur-sm mb-6">
                    <span class="w-2 h-2 rounded-full bg-brand-cyan"></span>
                    <span class="text-xs font-medium text-brand-cyan tracking-wide uppercase">Service Focus</span>
                </div>
                <h1 class="text-4xl md:text-6xl font-bold mb-6"><?php the_title(); ?></h1>
            </header>

            <div class="glass-panel p-8 md:p-12 rounded-2xl prose prose-invert prose-lg max-w-none">
                <?php
                if ( have_posts() ) :
                    while ( have_posts() ) : the_post();
                        the_content();
                    endwhile;
                endif;
                ?>
            </div>
            
            <div class="mt-12 text-center">
                <a href="<?php echo home_url(); ?>#contact" class="inline-block px-8 py-4 bg-brand-primary rounded-lg font-semibold hover:bg-blue-600 transition-colors">
                    Book a Consultation for this Service
                </a>
            </div>
        </div>
    </article>

    <?php wp_footer(); ?>
</body>
</html>
