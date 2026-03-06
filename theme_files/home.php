<?php
/*
Template Name: Blog Index
*/
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AI Insights Blog | Taylored AI</title>
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
            transition: all 0.3s ease;
        }
        .glass-panel:hover {
            border-color: rgba(6, 182, 212, 0.3);
            transform: translateY(-5px);
        }
    </style>
    <?php wp_head(); ?>
</head>
<body class="antialiased">

    <nav class="fixed w-full z-50 top-0 glass-panel border-b border-white/10">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <a href="<?php echo home_url(); ?>" class="flex items-center gap-3">
                <span class="text-xl font-bold tracking-tight">Taylored AI</span>
            </a>
            <div class="hidden md:flex space-x-8 text-sm font-medium text-gray-300">
                <a href="<?php echo home_url(); ?>" class="hover:text-brand-cyan transition-colors">Home</a>
                <a href="<?php echo home_url(); ?>#services" class="hover:text-brand-cyan transition-colors">Services</a>
            </div>
        </div>
    </nav>

    <header class="pt-32 pb-16 px-6 text-center">
        <h1 class="text-4xl md:text-6xl font-bold mb-6">Latest Intelligence</h1>
        <p class="text-gray-400 text-lg max-w-2xl mx-auto">
            Practical guides, strategic insights, and updates on the evolving world of enterprise AI.
        </p>
    </header>

    <main class="max-w-7xl mx-auto px-6 pb-24">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php
            // Custom query if this is a page template, or standard loop if index.php
            $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
            $args = array(
                'post_type' => 'post',
                'posts_per_page' => 9,
                'paged' => $paged
            );
            $the_query = new WP_Query( $args );

            if ( $the_query->have_posts() ) :
                while ( $the_query->have_posts() ) : $the_query->the_post();
            ?>
                <a href="<?php the_permalink(); ?>" class="glass-panel rounded-2xl overflow-hidden group block">
                    <div class="h-48 bg-gray-800 relative overflow-hidden">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <?php the_post_thumbnail('medium_large', ['class' => 'w-full h-full object-cover group-hover:scale-105 transition-transform duration-500']); ?>
                        <?php else: ?>
                            <div class="w-full h-full bg-gradient-to-br from-brand-card to-brand-dark flex items-center justify-center text-brand-primary opacity-30">
                                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="p-6">
                        <div class="text-xs text-brand-cyan mb-2 font-semibold uppercase tracking-wider"><?php echo get_the_date(); ?></div>
                        <h2 class="text-xl font-bold mb-3 group-hover:text-brand-primary transition-colors"><?php the_title(); ?></h2>
                        <div class="text-gray-400 text-sm line-clamp-3">
                            <?php the_excerpt(); ?>
                        </div>
                        <div class="mt-4 flex items-center text-brand-primary text-sm font-semibold">
                            Read Article <span class="ml-2 group-hover:translate-x-1 transition-transform">→</span>
                        </div>
                    </div>
                </a>
            <?php
                endwhile;
                wp_reset_postdata();
            else :
            ?>
                <div class="col-span-3 text-center py-12 text-gray-500">
                    <p>No insights published yet. Check back soon.</p>
                </div>
            <?php endif; ?>
        </div>
        
        <!-- Pagination -->
        <div class="mt-12 flex justify-center gap-4">
            <?php
            echo paginate_links( array(
                'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
                'total'        => $the_query->max_num_pages,
                'current'      => max( 1, get_query_var( 'paged' ) ),
                'format'       => '?paged=%#%',
                'show_all'     => false,
                'type'         => 'plain',
                'end_size'     => 2,
                'mid_size'     => 1,
                'prev_next'    => true,
                'prev_text'    => sprintf( '<i></i> %1$s', __( 'Previous', 'text-domain' ) ),
                'next_text'    => sprintf( '%1$s <i></i>', __( 'Next', 'text-domain' ) ),
                'add_args'     => false,
                'add_fragment' => '',
            ) );
            ?>
        </div>
    </main>

    <?php wp_footer(); ?>
</body>
</html>
