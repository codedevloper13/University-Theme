<footer class="site-footer">
   <div class="site-footer__inner container container--narrow">
      <div class="group">
         <div class="site-footer__col-one">
            <nav class="nav-list">
               <?php dynamic_sidebar('footer-1'); ?>
            </nav>
         </div>

         <div class="site-footer__col-two-three-group">
            <div class="site-footer__col-two">
               <nav class="nav-list">
                  <?php dynamic_sidebar('footer-2'); ?>
               </nav>
            </div>

            <div class="site-footer__col-three">

               <nav class="nav-list">
                  <?php dynamic_sidebar('footer-3'); ?>
               </nav>
            </div>
         </div>

         <div class="site-footer__col-four">

            <nav class="nav-list">
               <?php dynamic_sidebar('footer-4'); ?>
            </nav>
         </div>
      </div>
   </div>
</footer>
<?php wp_footer(); ?>
</body>

</html>