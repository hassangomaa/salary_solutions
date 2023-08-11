<!DOCTYPE html>
<html lang="ar">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>حلول الرواتب</title>
  <!-- إضافة رابط الـ CSS للـ Bootstrap -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <!-- إضافة الـ CSS المخصص إذا كنت بحاجة إليه -->
</head>
<body dir="rtl">
        <a href="{{ url('/') }}" class="btn btn-primary">التبديل للعرض الافتراضي</a>


<!-- شريط التنقل -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">حلول الرواتب</a>
</nav>

<!-- قسم الترحيب -->
<section class="jumbotron text-center bg-primary text-white">
  <div class="container">
    <h1 class="display-4">مرحبًا بك في حلول الرواتب</h1>
    <p class="lead">حلاك الكامل لإدارة الرواتب بفاعلية</p>
  </div>
</section>

<!-- قسم من نحن -->
<section class="container mt-5">
  <div class="row">
    <div class="col-md-6">
      <h2>من نحن</h2>
      <p>في حلول الرواتب، نتخصص في تقديم حلاً شاملاً لإدارة الرواتب يساعد الشركات على تبسيط عمليات الحسابات .</p>
    </div>
    <div class="col-md-6 text-center">
      <i class="fas fa-chart-line fa-5x"></i>
    </div>
  </div>
</section>

<!-- قسم قريباً -->
<section class="jumbotron text-center bg-secondary text-white">
  <div class="container">
    <h2>قريبًا</h2>
    <p class="lead">ترقبوا التحديثات المثيرة قريبًا!</p>
  </div>
</section>

<!-- إضافة أيقونات Font Awesome -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
<!-- إضافة الـ JS الخاص بالـ Bootstrap -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
