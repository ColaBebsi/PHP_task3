<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bank App</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <!-- Custom CSS -->
    <!-- <link rel="stylesheet" href="styles/style.css"> -->

    <!-- jQuery -->
    <script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script></head>
<body>
    <nav class="navbar navbar-dark bg-dark">
        <div class="input-group">
            <select class="custom-select" id="select_user">
                <option selected>Välj användare...</option>
            </select>

            <div class="input-group-append">
                <button class="btn btn-outline-secondary" id="select_btn" type="button">Välj</button>
            </div>
        </div>
    </nav>

    <div id="balance">
        <h3>Kontobalans:</h3>
        <div id="balance"></div>
    </div>

    <form action="" method="Post">
        <h3>Överföring</h3>
        <div class="form-group">
            <label for="from_account">Från konto:</label>
            <input disabled class="form-control" type="text" id="from_account">
         </div>

        <div class="form-group">
            <label for="to_account">Till konto med konto-id:</label>
            <select class="form-control" id="to_account">
                <option selected>Välj konto...</option>
            </select>
        </div>
        
        <label for="amount">Belopp:</label>
        <input type="number" class="form-control" id="amount">
        <button type="submit" class="btn btn-dark" id="send_btn">Överför</button>
        <!-- <div id="send_msg"></div> -->
    </form>




    <!-- Custom JS -->
    <script src="scripts/main2.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>