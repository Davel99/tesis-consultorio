
          </main>
<!-- ========================== END OF THE MAIN CONTENT ============================== -->


          <footer class="w-100 p-3 bg-primary text-light text-center">

            Derechos reservados &copy Joel David Gómez Ortega <?= date('Y') ?>


          </footer>



            <script type="text/javascript" src="<?= base_url ?>vendor/jquery/jquery.min.js"></script>
            <script type="text/javascript" src="<?= base_url ?>vendor/bootstrap/js/bootstrap.js"></script>
            <script type="text/javascript" src="<?= base_url ?>assets/js/main.js"></script>
            
            <?php if(file_exists("../assets/js/$folder/$cont/$action.js")): ?>
                <script type="text/javascript" src="<?= base_url ?>assets/js/<?=$folder?>/<?=$cont?>/<?=$action?>.js"></script>  
            <?php endif; ?>
    </body>
</html>
