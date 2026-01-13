<!--</div>-->
<div class="footer fixed-bottom">
      <!-- Footer -->
      <footer class="sticky-footer bg-white">
          <!--<footer class="sticky-footer bg-white mt-auto">-->
        <!--<div class="container my-auto">-->
          <div class="copyright text-center my-auto">
            <strong>© BPS Provinsi Jawa Timur <?php echo date('Y') ?>.</strong>
          </div>
        <!--</div>-->
      </footer>
      <!-- Footer -->
    </div>
  </div>

  <!-- Scroll to top -->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <script src="<?php echo base_url(); ?>assets/radmin/js/ruang-admin.min.js"></script>

  <!-- SweetAlert2 -->
  <!-- <script src="<?php echo base_url(); ?>assets/radmin/sweetalert2/sweetalert2.min.js"></script> -->
  <script src="<?php echo base_url(); ?>assets/radmin/sweetalertx/sweetalert2.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function(){
        <?php echo $this->session->flashdata('notif'); ?>
    });
  </script>

</body>

</html>