<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.0/css/bootstrap.min.css" integrity="sha384-SI27wrMjH3ZZ89r4o+fGIJtnzkAnFs3E4qz9DIYioCQ5l9Rd/7UAa8DHcaL8jkWt" crossorigin="anonymous">

    <title>SPK PEMIMPIN</title>
  </head>
  <body>

<!--navbar-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary mb-5">
      <a class="navbar-brand" href="index.php">SPK</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="data-pemimpin.php">Data Peserta<span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="bobot-kriteria.php">Bobot Kriteria</a>
          </li>
        </ul>
      </div>
    </nav>

<!--container-->
    <div class="container">
      <button class="btn btn-outline-secondary mb-3" onclick="sortTable()">Sort</button>
      <table class="table table-striped" id="myTable">
        <!--<thead>-->
          <tr class="thead-dark">
            <th>No</th>
            <th>Nama</th>
            <th>Keaktifan</th>
            <th>Nilai</th>
            <th>Pelanggaran</th>
            <th>Karir</th>
            <th>Nilai Total</th>
          </tr>
        <!--</thead>-->

        <?php
        include 'koneksi.php';
        $db = new database();
        $no = 1;
        $n_total = array();

        foreach($db->tampil_data_pemimpin() as $data){
          foreach($db->bobot_keaktifan() as $n_kr1){
            foreach($db->bobot_nilai() as $n_kr2){
              foreach($db->bobot_pelanggaran() as $n_kr3){
                foreach($db->bobot_karir() as $n_kr4){
                  foreach($db->nilai_benefit() as $pengali){ ?>
            <tr>
              <td><?php echo $no++ ?></td>
              <td><?php echo $data['nama_peserta']; ?></td>
              <td><?php echo $n_aktif = $data['keaktifan']/$pengali['p_aktif']*$n_kr1['bobot']; ?></td>
              <td><?php echo $n_nilai = $data['nilai']/$pengali['p_nilai']*$n_kr2['bobot']; ?></td>
              <td><?php echo $n_pelanggaran = $data['pelanggaran']/$pengali['p_pelanggaran']*$n_kr3['bobot']; ?></td>
              <td><?php echo $n_karir = $data['karir']/$pengali['p_karir']*$n_kr4['bobot']; ?></td>
              <td><?php echo $n_total = $n_aktif + $n_nilai + $n_pelanggaran + $n_karir ?></td>
            </tr>
        <?php }}}}}} ?>
      </table>
    </div>
    <!-- Optional JavaScript -->
    <script>
    function sortTable() {
      var table, rows, switching, i, x, y, shouldSwitch;
      table = document.getElementById("myTable");
      switching = true;
      /*Make a loop that will continue until
      no switching has been done:*/
      while (switching) {
        //start by saying: no switching is done:
        switching = false;
        rows = table.rows;
        /*Loop through all table rows (except the
        first, which contains table headers):*/
        for (i = 1; i < (rows.length - 1); i++) {
          //start by saying there should be no switching:
          shouldSwitch = false;
          /*Get the two elements you want to compare,
          one from current row and one from the next:*/
          x = rows[i].getElementsByTagName("TD")[6];
          y = rows[i + 1].getElementsByTagName("TD")[6];
          //check if the two rows should switch place:
          if (Number(x.innerHTML) < Number(y.innerHTML)) {
            //if so, mark as a switch and break the loop:
            shouldSwitch = true;
            break;
          }
        }
        if (shouldSwitch) {
          /*If a switch has been marked, make the switch
          and mark that a switch has been done:*/
          rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
          switching = true;
        }
      }
    }
    </script>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.0/js/bootstrap.min.js" integrity="sha384-3qaqj0lc6sV/qpzrc1N5DC6i1VRn/HyX4qdPaiEFbn54VjQBEU341pvjz7Dv3n6P" crossorigin="anonymous"></script>
  </body>
</html>
