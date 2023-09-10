  </div>
  <!-- Footer -->
  <footer class="sticky-footer bg-white">
      <div class="container my-auto">
          <div class="copyright text-center my-auto">
              <span>Copyright &copy; 2022</span>
          </div>
      </div>
  </footer>
  <!-- End of Footer -->

  </div>
  <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Siap untuk logout?</h5>
                  <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                  </button>
              </div>
              <div class="modal-body">Pilih "Logout" untuk meninggalkan halaman ini</div>
              <div class="modal-footer">
                  <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                  <a class="btn btn-primary" href="<?= site_url('login/logout') ?>">Logout</a>
              </div>
          </div>
      </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="<?php echo base_url("assets/admin/vendor/jquery/jquery.min.js"); ?>"></script>
  <script src="<?php echo base_url("assets/admin/vendor/bootstrap/js/bootstrap.bundle.min.js"); ?>"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?php echo base_url("assets/admin/vendor/jquery-easing/jquery.easing.min.js"); ?>"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?php echo base_url("assets/admin/js/sb-admin-2.min.js"); ?>"></script>

  <!-- Page level plugins -->
  <script src="<?php echo base_url("assets/admin/vendor/chart.js/Chart.min.js"); ?>"></script>

  <!-- Page level custom scripts -->
  <script src="<?php echo base_url("assets/admin/js/demo/chart-area-demo.js"); ?>"></script>
  <script src="<?php echo base_url("assets/admin/js/demo/chart-pie-demo.js"); ?>"></script>
  <!-- Page level plugins -->
  <script src="<?= base_url() ?>assets/admin/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="<?= base_url() ?>assets/admin/vendor/datatables/dataTables.bootstrap4.min.js"></script>
  <script src="<?php echo base_url("assets/admin/js/demo/datatables-demo.js"); ?>"></script>
  <script>
    // Get references to the select elements
    const selectMapel = document.getElementById("selectMapel");
    const selectGuru = document.getElementById("selectGuru");

    // Function to fetch and populate teachers based on the selected subject
    function populateGuru() {
        const selectedMapel = selectMapel.value;
        if (selectedMapel === "") {
            selectGuru.innerHTML = "<option value=''>Pilih Guru Pengajar</option>";
            selectGuru.disabled = true;
            return;
        }

        // Fetch teachers for the selected subject using AJAX or any other method
        // Replace the URL with the actual endpoint to fetch teachers for the selected subject
        fetch(`/getTeachersForSubject?id_mapel=${selectedMapel}`)
            .then((response) => response.json())
            .then((data) => {
                let options = "<option value=''>Pilih Guru Pengajar</option>";
                data.forEach((guru) => {
                    options += `<option value="${guru.id_guru}">${guru.nama_guru}</option>`;
                });
                selectGuru.innerHTML = options;
                selectGuru.disabled = false;
            })
            .catch((error) => {
                console.error("Error fetching teachers:", error);
                selectGuru.innerHTML = "<option value=''>Pilih Guru Pengajar</option>";
                selectGuru.disabled = true;
            });
    }

    // Listen for changes on the subject dropdown and call the populateGuru function
    selectMapel.addEventListener("change", populateGuru);
</script>
  </body>
 
  </html>