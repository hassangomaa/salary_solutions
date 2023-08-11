<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SalarySolutions</title>
  <!-- Add Bootstrap CSS link -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <!-- Add your custom CSS if needed -->
</head>
<body>
    <a href="{{ route('welcome_ar') }}" class="btn btn-primary">Switch to Arabic</a>

<!-- Navigation bar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">SalarySolutions</a>
</nav>

<!-- Welcome Section -->
<section class="jumbotron text-center bg-primary text-white">
  <div class="container">
    <h1 class="display-4">Welcome to SalarySolutions</h1>
    <p class="lead">Your Solution for Efficient Payroll Management</p>
  </div>
</section>

<!-- About Us Section -->
<section class="container mt-5">
  <div class="row">
    <div class="col-md-6">
      <h2>About Us</h2>
      <p>At SalarySolutions, we specialize in providing comprehensive payroll management solutions that help businesses streamline their compensation processes.</p>
    </div>
    <div class="col-md-6">
      <i class="fas fa-chart-line fa-5x"></i>
    </div>
  </div>
</section>

<!-- Coming Soon Section -->
<section class="jumbotron text-center bg-secondary text-white">
  <div class="container">
    <h2>Coming Soon</h2>
    <p class="lead">Stay tuned for exciting updates!</p>
  </div>
</section>

<!-- Add your footer if needed -->

<!-- Add Font Awesome icons -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
<!-- Add Bootstrap JS scripts -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
