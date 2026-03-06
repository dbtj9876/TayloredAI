<?php
get_header(); 
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
                <a href="<?php echo home_url(); ?>/blog" class="hover:text-brand-cyan transition-colors">Back to Blog</a>
            </div>
        </div>
    </nav>

    <!-- ARTICLE CONTENT -->
    <article class="pt-32 pb-24 px-6">
        <div class="max-w-3xl mx-auto">
            <header class="mb-10 text-center">
                <div class="text-brand-cyan font-semibold uppercase tracking-widest text-sm mb-4"><?php echo get_the_category_list(', '); ?></div>
                <h1 class="text-4xl md:text-5xl font-bold mb-6 leading-tight"><?php the_title(); ?></h1>
                <div class="text-gray-400 text-sm">
                    By <?php the_author(); ?> • <?php echo get_the_date(); ?>
                </div>
            </header>

            <?php if ( has_post_thumbnail() ) : ?>
                <div class="mb-12 rounded-2xl overflow-hidden shadow-2xl border border-white/10">
                    <?php the_post_thumbnail('large', ['class' => 'w-full h-auto']); ?>
                </div>
            <?php endif; ?>

            <div class="prose prose-invert prose-lg max-w-none prose-a:text-brand-cyan hover:prose-a:text-brand-primary">
                <?php
                if ( have_posts() ) :
                    while ( have_posts() ) : the_post();
                        the_content();
                    endwhile;
                endif;
                ?>
            </div>
            
            <!-- Author Bio / CTA -->
            <div class="mt-16 p-8 glass-panel rounded-2xl border border-brand-primary/20 flex flex-col md:flex-row items-center gap-6">
                <div class="flex-1 text-center md:text-left">
                    <h3 class="text-xl font-bold mb-2">Ready to apply these insights?</h3>
                    <p class="text-gray-400 mb-4">Taylored AI helps enterprises turn strategy into execution.</p>
                    <a href="<?php echo home_url(); ?>#contact" class="text-brand-cyan font-semibold hover:underline">Book a Consultation →</a>
                </div>
            </div>
        </div>
    </article>

    <?php wp_footer(); ?>
</body>
</html>
