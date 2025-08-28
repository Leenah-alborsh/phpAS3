<?php

session_start();

$github_link = "https://github.com/Leenah-alborsh/phpAS3/blob/main/table.php";

/*  البيانات */
if (isset($_SESSION['students'])) {
  $_SESSION['students'] = [
    ['stdNo' => '20003', 'stdName' => 'Ahmed Ali', 'stdEmail' => 'ahmed@gmail.com', 'stdGAP' => 88.7],
    ['stdNo' => '30304', 'stdName' => 'Mona Khalid', 'stdEmail' => 'mona@gmail.com', 'stdGAP' => 78.5],
    ['stdNo' => '10002', 'stdName' => 'Bilal Hmaza', 'stdEmail' => 'bilal@gmail.com', 'stdGAP' => 98.7],
    ['stdNo' => '10005', 'stdName' => 'Said Ali', 'stdEmail' => 'said@gmail.com', 'stdGAP' => 98.7],
    ['stdNo' => '10007', 'stdName' => 'Mohammed ahmed', 'stdEmail' => 'mohamed@gmail.com', 'stdGAP' => 98.7],
  ];
}
$students = $_SESSION['students'];

/* دوال  */
function letterOf($g)
{
  if ($g >= 97)
    return 'A+';
  if ($g >= 90)
    return 'A';
  if ($g >= 80)
    return 'B';
  if ($g >= 70)
    return 'C';
  if ($g >= 60)
    return 'D';
  return 'F';
}
function gradeBadgeClass($grade)
{
  return ['A+' => 'bg-success', 'A' => 'bg-success', 'B' => 'bg-primary', 'C' => 'bg-warning text-dark', 'D' => 'bg-warning text-dark', 'F' => 'bg-danger'][$grade] ?? 'bg-secondary';
}
function keep($overrides = [])
{
  $params = $_GET;
  foreach ($overrides as $k => $v) {
    if ($v === null) {
      unset($params[$k]);
    } else {
      $params[$k] = $v;
    }
  }
  $q = http_build_query($params);
  return ($q ? '?' : '') . $q;
}
function hidden_keep_fields($fields)
{
  foreach ($fields as $f) {
    if (isset($_GET[$f]))
      echo '<input type="hidden" name="' . htmlspecialchars($f) . '" value="' . htmlspecialchars($_GET[$f]) . '">';
  }
}
function findIndexByNo($arr, $no)
{
  foreach ($arr as $i => $row) {
    if ($row['stdNo'] === $no)
      return $i;
  }
  return -1;
}
function redirect_after_post($extra = [])
{
  header("Location: " . keep($extra));
  exit;
}

/*  لتغيير اللغات */
$lang = (isset($_GET['lang']) && $_GET['lang'] === 'en') ? 'en' : 'ar';
$dir = $lang === 'ar' ? 'rtl' : 'ltr';
$T = [
  'ar' => [
    'title' => 'قائمة الطلاب',
    'subtitle' => '',
    'toggleLang' => 'English',
    'toggleTheme' => 'تبديل الوضع',
    'toggleView' => ['table' => 'جدول', 'cards' => 'بطاقات'],
    'searchPh' => 'بحث (اسم / بريد / رقم)',
    'grade' => 'الدرجة',
    'btnSearch' => 'بحث',
    'stats' => ['count' => 'عدد النتائج', 'avg' => 'متوسط المعدّل', 'max' => 'أعلى قيمة', 'min' => 'أدنى قيمة'],
    'dist' => 'توزيع الدرجات',
    'studentsNum' => 'عدد الطلاب',
    'noData' => 'لا نتائج',
    'tableHeads' => ['#', 'رقم الطالب', 'الاسم', 'البريد الإلكتروني', 'المعدل', 'الدرجة', 'إجراءات'],
    'legend' => ['A+' => 'A+', 'A' => 'A', 'B' => 'B', 'C' => 'C', 'D' => 'D', 'F' => 'F'],
    'addStudent' => 'إضافة طالب',
    'editStudent' => 'تعديل طالب',
    'stdNo' => 'رقم الطالب',
    'stdName' => 'الاسم',
    'stdEmail' => 'البريد الإلكتروني',
    'stdGAP' => 'المعدل (0-100)',
    'save' => 'حفظ',
    'cancel' => 'إلغاء',
    'edit' => 'تعديل',
    'delete' => 'حذف',
    'flash_added' => 'تمت إضافة الطالب بنجاح',
    'flash_updated' => 'تم تعديل بيانات الطالب',
    'flash_deleted' => 'تم حذف الطالب',
    'err_required' => 'يرجى تعبئة جميع الحقول',
    'err_duplicate' => 'رقم الطالب مستخدم مسبقًا',
    'err_gpa' => 'المعدل يجب أن يكون بين 0 و 100',
    'csv' => 'CSV',
    'json' => 'JSON',
    'printable' => 'نسخة للطباعة / PDF',
    'btnExport' => 'تصدير'
  ],
  'en' => [
    'title' => 'Students List',
    'subtitle' => '',
    'toggleLang' => 'العربية',
    'toggleTheme' => 'Toggle Theme',
    'toggleView' => ['table' => 'Table', 'cards' => 'Cards'],
    'searchPh' => 'Search (Name / Email / ID)',
    'grade' => 'Grade',
    'btnSearch' => 'Search',
    'stats' => ['count' => 'Results Count', 'avg' => 'Average GPA', 'max' => 'Max GPA', 'min' => 'Min GPA'],
    'dist' => 'Grade Distribution',
    'studentsNum' => 'Students Number',
    'noData' => 'No data',
    'tableHeads' => ['#', 'Student No.', 'Name', 'Email', 'GPA', 'Grade', 'Actions'],
    'legend' => ['A+' => 'A+', 'A' => 'A', 'B' => 'B', 'C' => 'C', 'D' => 'D', 'F' => 'F'],
    'addStudent' => 'Add Student',
    'editStudent' => 'Edit Student',
    'stdNo' => 'Student No',
    'stdName' => 'Name',
    'stdEmail' => 'Email',
    'stdGAP' => 'GPA (0-100)',
    'save' => 'Save',
    'cancel' => 'Cancel',
    'edit' => 'Edit',
    'delete' => 'Delete',
    'flash_added' => 'Student added successfully',
    'flash_updated' => 'Student updated',
    'flash_deleted' => 'Student deleted',
    'err_required' => 'Please fill in all fields',
    'err_duplicate' => 'Student No already exists',
    'err_gpa' => 'GPA must be between 0 and 100',
    'csv' => 'CSV',
    'json' => 'JSON',
    'printable' => 'Printable / PDF',
    'btnExport' => 'Export'
  ]
];

/*  لأخذ مدخلات  */
$q = $_GET['q'] ?? '';
$grade = $_GET['grade'] ?? '';
$sort = $_GET['sort'] ?? 'stdNo';
$dirS = $_GET['dir'] ?? 'asc';
$view = $_GET['view'] ?? 'table';
$theme = $_GET['theme'] ?? 'light';
$export = $_GET['export'] ?? '';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);

$editNo = $_GET['edit'] ?? null;
$editRow = null;
if ($editNo !== null) {
  $idx = findIndexByNo($students, $editNo);
  if ($idx >= 0)
    $editRow = $students[$idx];
}

$action = $_POST['action'] ?? null;
if ($action) {
  $in = [
    'stdNo' => trim($_POST['stdNo'] ?? ''),
    'stdName' => trim($_POST['stdName'] ?? ''),
    'stdEmail' => trim($_POST['stdEmail'] ?? ''),
    'stdGAP' => isset($_POST['stdGAP']) ? floatval($_POST['stdGAP']) : null,
  ];
  $errors = [];

  if ($action === 'delete') {
    $no = $_POST['stdNo'] ?? '';
    $i = findIndexByNo($students, $no);
    if ($i >= 0) {
      array_splice($students, $i, 1);
      $_SESSION['students'] = $students;
      $_SESSION['flash'] = ['type' => 'success', 'msg' => $T[$lang]['flash_deleted']];
    }
    redirect_after_post([]);
  } else {
    if ($in['stdNo'] === '' || $in['stdName'] === '' || $in['stdEmail'] === '' || $_POST['stdGAP'] === '')
      $errors[] = $T[$lang]['err_required'];
    if (!is_null($in['stdGAP']) && ($in['stdGAP'] < 0 || $in['stdGAP'] > 100))
      $errors[] = $T[$lang]['err_gpa'];

    if ($action === 'create') {
      if (findIndexByNo($students, $in['stdNo']) >= 0)
        $errors[] = $T[$lang]['err_duplicate'];
      if ($errors) {
        $editRow = $in;
        $editNo = null;
        $flash = ['type' => 'danger', 'msg' => implode(' • ', $errors)];
      } else {
        $students[] = $in;
        $_SESSION['students'] = $students;
        $_SESSION['flash'] = ['type' => 'success', 'msg' => $T[$lang]['flash_added']];
        redirect_after_post([]);
      }
    }
    if ($action === 'update') {
      $original = $_POST['originalNo'] ?? '';
      $i = findIndexByNo($students, $original);
      if ($i < 0) {
        redirect_after_post([]);
      }
      if ($in['stdNo'] !== $original && findIndexByNo($students, $in['stdNo']) >= 0)
        $errors[] = $T[$lang]['err_duplicate'];
      if ($errors) {
        $editRow = $in;
        $editNo = $original;
        $flash = ['type' => 'danger', 'msg' => implode(' • ', $errors)];
      } else {
        $students[$i] = $in;
        $_SESSION['students'] = $students;
        $_SESSION['flash'] = ['type' => 'success', 'msg' => $T[$lang]['flash_updated']];
        redirect_after_post(['edit' => null]);
      }
    }
  }
}

/*    ترتيب */
$filtered = array_filter($students, function ($s) use ($q, $grade) {
  $L = letterOf($s['stdGAP']);
  $textOK = $q === '' || stripos($s['stdNo'], $q) !== false || stripos($s['stdName'], $q) !== false || stripos($s['stdEmail'], $q) !== false;
  $gradeOK = ($grade === '' || $L === $grade);
  return $textOK && $gradeOK;
});
usort($filtered, function ($a, $b) use ($sort, $dirS) {
  $va = ($sort === 'grade') ? letterOf($a['stdGAP']) : $a[$sort];
  $vb = ($sort === 'grade') ? letterOf($b['stdGAP']) : $b[$sort];
  if ($sort === 'stdGAP') {
    $va = floatval($va);
    $vb = floatval($vb);
  }
  $cmp = ($va <=> $vb);
  return $dirS === 'asc' ? $cmp : -$cmp;
});

/*  تصدير CSV / JSON / Printable  */
if ($export === 'csv') {
  header('Content-Type: text/csv; charset=UTF-8');
  header('Content-Disposition: attachment; filename="students.csv"');
  $out = fopen('php://output', 'w');
  fprintf($out, chr(0xEF) . chr(0xBB) . chr(0xBF)); // BOM للعربي
  fputcsv($out, ['stdNo', 'stdName', 'stdEmail', 'stdGAP', 'grade']);
  foreach ($filtered as $s) {
    fputcsv($out, [$s['stdNo'], $s['stdName'], $s['stdEmail'], $s['stdGAP'], letterOf($s['stdGAP'])]);
  }
  fclose($out);
  exit;
}
if ($export === 'json') {
  header('Content-Type: application/json; charset=UTF-8');
  echo json_encode(array_map(function ($s) {
    return $s + ['grade' => letterOf($s['stdGAP'])]; }, array_values($filtered)), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
  exit;
}
if ($export === 'print') {
  ?>
  <!doctype html>
  <html lang="<?= $lang ?>" dir="<?= $dir ?>">

  <head>
    <meta charset="utf-8">
    <title><?= htmlspecialchars($T[$lang]['title']) ?> - Print</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
      body {
        font-family: system-ui, -apple-system, "Segoe UI", Roboto, Arial;
      }

      h4 {
        margin: 1rem 0;
      }

      .small-muted {
        color: #6c757d;
      }

      @media print {
        .no-print {
          display: none !important;
        }
      }

      .badge {
        border-radius: 999px;
      }
    </style>
  </head>

  <body class="p-4">
    <div class="d-flex justify-content-between align-items-center no-print">
      <h4 class="m-0"><?= htmlspecialchars($T[$lang]['title']) ?></h4>
      <a class="btn btn-primary" href="javascript:print()"><?= $lang === 'ar' ? 'طباعة' : 'Print' ?></a>
    </div>
    <div class="small-muted mb-3"><?= htmlspecialchars($T[$lang]['subtitle']) ?></div>
    <table class="table table-bordered table-sm align-middle">
      <thead class="table-light">
        <tr>
          <th>#</th>
          <th><?= $lang === 'ar' ? 'رقم الطالب' : 'Student No' ?></th>
          <th><?= $lang === 'ar' ? 'الاسم' : 'Name' ?></th>
          <th><?= $lang === 'ar' ? 'البريد الإلكتروني' : 'Email' ?></th>
          <th><?= $lang === 'ar' ? 'المعدل' : 'GPA' ?></th>
          <th><?= $lang === 'ar' ? 'الدرجة' : 'Grade' ?></th>
        </tr>
      </thead>
      <tbody>
        <?php $i = 1;
        foreach ($filtered as $s):
          $L = letterOf($s['stdGAP']); ?>
          <tr>
            <td><?= $i++ ?></td>
            <td><?= htmlspecialchars($s['stdNo']) ?></td>
            <td><?= htmlspecialchars($s['stdName']) ?></td>
            <td><?= htmlspecialchars($s['stdEmail']) ?></td>
            <td><?= $s['stdGAP'] ?></td>
            <td><?= $L ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </body>

  </html>
  <?php exit;
}

/*   مخطط */
$count = count($filtered);
$avg = $count ? array_sum(array_column($filtered, 'stdGAP')) / $count : 0;
$maxv = $count ? max(array_column($filtered, 'stdGAP')) : 0;
$minv = $count ? min(array_column($filtered, 'stdGAP')) : 0;

$bucketKeys = ['A+', 'A', 'B', 'C', 'D', 'F'];
$buckets = array_fill_keys($bucketKeys, 0);
foreach ($filtered as $s) {
  $buckets[letterOf($s['stdGAP'])]++;
}

function donutSegments($buckets)
{
  $total = array_sum($buckets);
  $r = 70;
  $C = 2 * M_PI * $r;
  $colors = ['A+' => '#16c172', 'A' => '#2ecc71', 'B' => '#3498db', 'C' => '#f1c40f', 'D' => '#ffb84d', 'F' => '#e74c3c'];
  $out = [];
  if ($total == 0) {
    $out[] = ['dash' => $C, 'gap' => 0, 'offset' => 0, 'color' => '#d0d7de'];
    return [$out, $r, $C, $colors];
  }
  $offset = 0;
  foreach ($buckets as $g => $n) {
    if ($n <= 0)
      continue;
    $dash = ($n / $total) * $C;
    $out[] = ['dash' => $dash, 'gap' => $C - $dash, 'offset' => -$offset, 'color' => $colors[$g]];
    $offset += $dash;
  }
  return [$out, $r, $C, $colors];
}
[$segments, $rSVG, $cSVG, $colors] = donutSegments($buckets);
?>
<!doctype html>
<html lang="<?= $lang ?>" dir="<?= $dir ?>" data-bs-theme="<?= htmlspecialchars($theme) ?>">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= htmlspecialchars($T[$lang]['title']) ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    :root {
      --accent: #6f6cf8;
    }

    /* نهاري */
    body {
      min-height: 100vh;
      background: linear-gradient(135deg, #e3f2fd 0%, #fdfdff 100%);
      font-family: system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", "Apple Color Emoji", "Segoe UI Emoji";
      color: #212529;
    }

    /* ليلي */
    [data-bs-theme="dark"] body {
      background:
        radial-gradient(900px 500px at -10% 100%, #7d5cff33 0%, transparent 60%),
        radial-gradient(1200px 600px at 80% -10%, #65e5ff33 0%, transparent 60%),
        linear-gradient(135deg, #0b1220, #141c2c);
      color: #f8f9fa;
    }

    .glass {
      background: rgba(255, 255, 255, .95);
      border: 1px solid #d6e9f9;
      box-shadow: 0 4px 12px rgba(0, 0, 0, .08);
      border-radius: 20px;
      transition: all .25s;
    }

    [data-bs-theme="dark"] .glass {
      background: rgba(255, 255, 255, .08);
      border-color: rgba(255, 255, 255, .2);
    }

    .glass:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 16px rgba(0, 0, 0, .12);
    }

    .cardx {
      background: #fff;
      border: 1px solid #d6e9f9;
      box-shadow: 0 2px 8px rgba(0, 0, 0, .06);
      border-radius: 18px;
      transition: all .25s;
    }

    [data-bs-theme="dark"] .cardx {
      background: rgba(255, 255, 255, .05);
      border-color: rgba(255, 255, 255, .2);
    }

    .cardx:hover {
      transform: translateY(-3px);
      box-shadow: 0 6px 18px rgba(0, 0, 0, .15);
    }

    .btn-accent {
      background: var(--accent);
      color: #fff;
      border-color: var(--accent);
      transition: all .2s;
    }

    .btn-accent:hover,
    .btn-accent:focus {
      background: #5856d6;
      border-color: #5856d6;
      color: #fff;
      box-shadow: 0 0 0 .25rem rgba(111, 108, 248, .35);
    }

    .btn-outline-primary:hover {
      background: #0d6efd;
      color: #fff;
    }

    .btn-outline-secondary:hover {
      background: #6c757d;
      color: #fff;
    }

    .btn-outline-success:hover {
      background: #198754;
      color: #fff;
    }

    .btn-outline-danger:hover {
      background: #dc3545;
      color: #fff;
    }

    .btn-outline-info:hover {
      background: #0dcaf0;
      color: #fff;
    }

    .btn-outline-dark:hover {
      background: #212529;
      color: #fff;
    }

    a {
      color: var(--accent);
      text-decoration: none;
      transition: color .2s;
    }

    a:hover {
      color: #4834d4;
      text-decoration: underline;
    }

    .table thead th a {
      text-decoration: none;
      color: inherit;
    }

    .legend-dot {
      width: 10px;
      height: 10px;
      border-radius: 50%;
      display: inline-block;
      margin-inline-end: 6px;
    }

    .chip {
      border-radius: 999px;
      padding: .2rem .6rem;
      font-weight: 600;
    }

    .subtle {
      color: #495057;
    }

    [data-bs-theme="dark"] .subtle {
      color: #adb5bd;
    }

    /*  كرت التسليم */
    .submit-card {
      border-radius: 14px;
      padding: 12px 16px;
      border: 1px solid #d6e9f9;
      background: #fff;
      box-shadow: 0 2px 8px rgba(0, 0, 0, .06);
    }

    [data-bs-theme="dark"] .submit-card {
      background: rgba(255, 255, 255, .06);
      border-color: rgba(255, 255, 255, .2);
    }
  </style>
</head>

<body>

  <div class="container py-4">

    <!--GitHub -->
    <div class="submit-card mb-3 d-flex flex-wrap align-items-center justify-content-between gap-2">
      <div class="fw-semibold">
        🔗 GitHub:
        <a href="<?php echo htmlspecialchars($github_link, ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noopener">
          <?php echo htmlspecialchars($github_link, ENT_QUOTES, 'UTF-8'); ?>
        </a>
      </div>
      <a class="btn btn-accent btn-sm" href="<?php echo htmlspecialchars($github_link, ENT_QUOTES, 'UTF-8'); ?>"
        target="_blank" rel="noopener">
        فتح الملف على GitHub
      </a>
    </div>

    <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-2 mb-3">
      <div>
        <h3 class="m-0"><?= htmlspecialchars($T[$lang]['title']) ?></h3>
        <small class="subtle"><?= htmlspecialchars($T[$lang]['subtitle']) ?></small>
      </div>
      <div class="d-flex flex-wrap gap-2">
        <a class="btn btn-outline-primary" href="<?= keep(['lang' => $lang === 'ar' ? 'en' : 'ar']) ?>">🌐
          <?= htmlspecialchars($T[$lang]['toggleLang']) ?></a>
        <a class="btn btn-outline-secondary" href="<?= keep(['theme' => $theme === 'dark' ? 'light' : 'dark']) ?>">🌓
          <?= htmlspecialchars($T[$lang]['toggleTheme']) ?></a>
        <div class="btn-group">
          <a class="btn <?= $view === 'table' ? 'btn-accent' : 'btn-outline-secondary' ?>"
            href="<?= keep(['view' => 'table']) ?>"><?= htmlspecialchars($T[$lang]['toggleView']['table']) ?></a>
          <a class="btn <?= $view === 'cards' ? 'btn-accent' : 'btn-outline-secondary' ?>"
            href="<?= keep(['view' => 'cards']) ?>"><?= htmlspecialchars($T[$lang]['toggleView']['cards']) ?></a>
        </div>
        <!-- الأزرار  -->
        <div class="btn-group">
          <a class="btn btn-outline-success" href="<?= keep(['export' => 'csv']) ?>">🗂
            <?= htmlspecialchars($T[$lang]['csv']) ?></a>
          <a class="btn btn-outline-info" href="<?= keep(['export' => 'json']) ?>">🧩
            <?= htmlspecialchars($T[$lang]['json']) ?></a>
          <a class="btn btn-outline-dark" href="<?= keep(['export' => 'print']) ?>" target="_blank">🖨️
            <?= htmlspecialchars($T[$lang]['printable']) ?></a>
        </div>
      </div>
    </div>

    <?php if ($flash): ?>
      <div class="alert alert-<?= htmlspecialchars($flash['type']) ?>"><?= htmlspecialchars($flash['msg']) ?></div>
    <?php endif; ?>

    <!--  اضافة و تعديل -->
    <div class="glass p-3 p-md-4 mb-4">
      <h5 class="mb-3"><?= htmlspecialchars($editRow ? $T[$lang]['editStudent'] : $T[$lang]['addStudent']) ?></h5>
      <form method="post" class="row g-3">
        <div class="col-12 col-md-3">
          <label class="form-label"><?= htmlspecialchars($T[$lang]['stdNo']) ?></label>
          <input name="stdNo" class="form-control" value="<?= htmlspecialchars($editRow['stdNo'] ?? '') ?>">
        </div>
        <div class="col-12 col-md-3">
          <label class="form-label"><?= htmlspecialchars($T[$lang]['stdName']) ?></label>
          <input name="stdName" class="form-control" value="<?= htmlspecialchars($editRow['stdName'] ?? '') ?>">
        </div>
        <div class="col-12 col-md-3">
          <label class="form-label"><?= htmlspecialchars($T[$lang]['stdEmail']) ?></label>
          <input name="stdEmail" class="form-control" value="<?= htmlspecialchars($editRow['stdEmail'] ?? '') ?>">
        </div>
        <div class="col-12 col-md-3">
          <label class="form-label"><?= htmlspecialchars($T[$lang]['stdGAP']) ?></label>
          <input name="stdGAP" type="number" step="0.1" min="0" max="100" class="form-control"
            value="<?= htmlspecialchars($editRow['stdGAP'] ?? '') ?>">
        </div>
        <div class="col-12 d-flex gap-2">
          <?php if ($editRow): ?>
            <input type="hidden" name="action" value="update">
            <input type="hidden" name="originalNo" value="<?= htmlspecialchars($_GET['edit']) ?>">
            <button class="btn btn-accent"><?= htmlspecialchars($T[$lang]['save']) ?></button>
            <a class="btn btn-outline-secondary"
              href="<?= keep(['edit' => null]) ?>"><?= htmlspecialchars($T[$lang]['cancel']) ?></a>
          <?php else: ?>
            <input type="hidden" name="action" value="create">
            <button class="btn btn-accent"><?= htmlspecialchars($T[$lang]['addStudent']) ?></button>
          <?php endif; ?>
          <?php hidden_keep_fields(['lang', 'theme', 'view', 'sort', 'dir', 'q', 'grade']); ?>
        </div>
      </form>
    </div>

    <!-- الفلاتر -->
    <form method="get" class="glass p-3 p-md-4 mb-4">
      <div class="row g-3 align-items-end">
        <div class="col-12 col-md-7">
          <label class="form-label"><?= htmlspecialchars($T[$lang]['searchPh']) ?></label>
          <input name="q" value="<?= htmlspecialchars($q) ?>" type="search" class="form-control"
            placeholder="<?= htmlspecialchars($T[$lang]['searchPh']) ?>">
        </div>
        <div class="col-8 col-md-3">
          <label class="form-label"><?= htmlspecialchars($T[$lang]['grade']) ?></label>
          <select name="grade" class="form-select">
            <?php $opts = ['' => '—', 'A+' => 'A+', 'A' => 'A', 'B' => 'B', 'C' => 'C', 'D' => 'D', 'F' => 'F'];
            foreach ($opts as $k => $v) {
              $sel = ($grade === $k) ? 'selected' : '';
              echo "<option value=\"{$k}\" {$sel}>{$v}</option>";
            } ?>
          </select>
        </div>
        <div class="col-4 col-md-2 d-grid">
          <button class="btn btn-accent" type="submit"><?= htmlspecialchars($T[$lang]['btnSearch']) ?></button>
        </div>
      </div>
      <input type="hidden" name="lang" value="<?= htmlspecialchars($lang) ?>">
      <input type="hidden" name="view" value="<?= htmlspecialchars($view) ?>">
      <input type="hidden" name="theme" value="<?= htmlspecialchars($theme) ?>">
      <input type="hidden" name="sort" value="<?= htmlspecialchars($sort) ?>">
      <input type="hidden" name="dir" value="<?= htmlspecialchars($dirS) ?>">
    </form>

    <!-- الاحصائيات -->
    <div class="row g-3 mb-4">
      <div class="col-6 col-lg-3">
        <div class="card cardx p-3 text-center">
          <div class="small subtle"><?= $T[$lang]['stats']['count'] ?></div>
          <div class="fs-4 fw-bold"><?= $count ?></div>
        </div>
      </div>
      <div class="col-6 col-lg-3">
        <div class="card cardx p-3 text-center">
          <div class="small subtle"><?= $T[$lang]['stats']['avg'] ?></div>
          <div class="fs-4 fw-bold"><?= $count ? number_format($avg, 2) : '—' ?></div>
        </div>
      </div>
      <div class="col-6 col-lg-3">
        <div class="card cardx p-3 text-center">
          <div class="small subtle"><?= $T[$lang]['stats']['max'] ?></div>
          <div class="fs-4 fw-bold"><?= $count ? number_format($maxv, 1) : '—' ?></div>
        </div>
      </div>
      <div class="col-6 col-lg-3">
        <div class="card cardx p-3 text-center">
          <div class="small subtle"><?= $T[$lang]['stats']['min'] ?></div>
          <div class="fs-4 fw-bold"><?= $count ? number_format($minv, 1) : '—' ?></div>
        </div>
      </div>
    </div>

    <!-- المخطط -->
    <div class="glass p-4 mb-4">
      <div class="row align-items-center g-4">
        <div class="col-12 col-md-6 d-flex justify-content-center">
          <?php
          $r = $rSVG;
          echo '<svg width="200" height="200" viewBox="0 0 200 200">';
          echo '<circle cx="100" cy="100" r="' . $r . '" fill="none" stroke="rgba(160,170,180,.3)" stroke-width="24"/>';
          foreach ($segments as $seg) {
            echo '<circle cx="100" cy="100" r="' . $r . '" fill="none" stroke="' . $seg['color'] . '" stroke-width="24" ' .
              'stroke-dasharray="' . $seg['dash'] . ' ' . ($seg['gap']) . '" stroke-dashoffset="' . $seg['offset'] . '" ' .
              'transform="rotate(-90,100,100)"/>';
          }
          $centerText = $count ? ($lang === 'ar' ? $count . ' طالب' : $count . ' student' . ($count > 1 ? 's' : '')) : $T[$lang]['noData'];
          echo '<text x="100" y="100" text-anchor="middle" dominant-baseline="middle" font-size="16" fill="currentColor" style="font-family:system-ui;">' .
            htmlspecialchars($centerText) . '</text>';
          echo '</svg>';
          ?>
        </div>
        <div class="col-12 col-md-6">
          <h6 class="mb-3"><?= htmlspecialchars($T[$lang]['dist']) ?></h6>
          <div class="row row-cols-2 row-cols-md-3 g-2">
            <?php foreach (['A+', 'A', 'B', 'C', 'D', 'F'] as $gk): ?>
              <div class="col">
                <div class="d-flex align-items-center gap-2 small">
                  <span class="legend-dot" style="background:<?= $colors[$gk] ?>"></span>
                  <span class="fw-semibold"><?= htmlspecialchars($T[$lang]['legend'][$gk]) ?></span>
                  <span class="subtle ms-auto"><?= $buckets[$gk] ?></span>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    </div>

    <?php if ($view === 'cards'): ?>
      <!--  عشكل البطاقات -->
      <div class="row g-4">
        <?php foreach ($filtered as $s):
          $L = letterOf($s['stdGAP']); ?>
          <div class="col-12 col-md-6 col-lg-4">
            <div class="card cardx p-3">
              <div class="d-flex justify-content-between align-items-start">
                <div>
                  <h5 class="m-0"><?= htmlspecialchars($s['stdName']) ?></h5>
                  <small class="subtle"><?= $lang === 'ar' ? 'الرقم:' : 'ID:' ?>     <?= htmlspecialchars($s['stdNo']) ?></small>
                </div>
                <span class="badge <?= gradeBadgeClass($L) ?> chip"><?= $T[$lang]['legend'][$L] ?></span>
              </div>
              <div class="mt-2 small subtle">📧 <a
                  href="mailto:<?= htmlspecialchars($s['stdEmail']) ?>"><?= htmlspecialchars($s['stdEmail']) ?></a></div>
              <div class="mt-1 small subtle">📈 <?= $lang === 'ar' ? 'المعدل:' : 'GPA:' ?> <strong><?= $s['stdGAP'] ?></strong>
              </div>
              <div class="progress mt-2" style="height:10px;">
                <div class="progress-bar" role="progressbar"
                  style="width: <?= min(max($s['stdGAP'], 0), 100) ?>%; background:var(--accent)"></div>
              </div>
              <div class="d-flex gap-2 mt-3">
                <a class="btn btn-sm btn-outline-primary"
                  href="<?= keep(['edit' => $s['stdNo']]) ?>"><?= htmlspecialchars($T[$lang]['edit']) ?></a>
                <form method="post" onsubmit="return confirm('<?= $lang === 'ar' ? 'تأكيد الحذف؟' : 'Confirm delete?' ?>');">
                  <input type="hidden" name="action" value="delete">
                  <input type="hidden" name="stdNo" value="<?= htmlspecialchars($s['stdNo']) ?>">
                  <?php hidden_keep_fields(['lang', 'theme', 'view', 'sort', 'dir', 'q', 'grade']); ?>
                  <button class="btn btn-sm btn-outline-danger"><?= htmlspecialchars($T[$lang]['delete']) ?></button>
                </form>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>

    <?php else: ?>
      <!-- عشكل الجدول -->
      <div class="glass p-2 p-md-3">
        <div class="table-responsive">
          <table class="table table-hover align-middle mb-0 <?= $dir === 'rtl' ? 'text-center' : '' ?>">
            <thead class="table-dark">
              <tr>
                <?php
                function sortLink($title, $key)
                {
                  global $sort, $dirS;
                  $newDir = ($sort === $key && $dirS === 'asc') ? 'desc' : 'asc';
                  $arrow = $sort === $key ? ($dirS === 'asc' ? '▲' : '▼') : '⬍';
                  return "<a href=\"" . keep(['sort' => $key, 'dir' => $newDir]) . "\">" . htmlspecialchars($title) . " {$arrow}</a>";
                }
                $heads = $T[$lang]['tableHeads'];
                ?>
                <th><?= sortLink($heads[0], 'stdNo') ?></th>
                <th class="text-start"><?= sortLink($heads[1], 'stdNo') ?></th>
                <th class="text-start"><?= sortLink($heads[2], 'stdName') ?></th>
                <th class="text-start"><?= sortLink($heads[3], 'stdEmail') ?></th>
                <th><?= sortLink($heads[4], 'stdGAP') ?></th>
                <th><?= sortLink($heads[5], 'grade') ?></th>
                <th><?= htmlspecialchars($heads[6]) ?></th>
              </tr>
            </thead>
            <tbody>
              <?php $i = 1;
              foreach ($filtered as $s):
                $L = letterOf($s['stdGAP']); ?>
                <tr>
                  <td><?= $i++ ?></td>
                  <td class="text-start"><?= htmlspecialchars($s['stdNo']) ?></td>
                  <td class="text-start"><?= htmlspecialchars($s['stdName']) ?></td>
                  <td class="text-start"><a
                      href="mailto:<?= htmlspecialchars($s['stdEmail']) ?>"><?= htmlspecialchars($s['stdEmail']) ?></a></td>
                  <td class="fw-semibold"><?= $s['stdGAP'] ?></td>
                  <td><span class="badge <?= gradeBadgeClass($L) ?> chip"><?= $T[$lang]['legend'][$L] ?></span></td>
                  <td class="text-nowrap">
                    <a class="btn btn-sm btn-outline-primary"
                      href="<?= keep(['edit' => $s['stdNo']]) ?>"><?= htmlspecialchars($T[$lang]['edit']) ?></a>
                    <form method="post" style="display:inline"
                      onsubmit="return confirm('<?= $lang === 'ar' ? 'تأكيد الحذف؟' : 'Confirm delete?' ?>');">
                      <input type="hidden" name="action" value="delete">
                      <input type="hidden" name="stdNo" value="<?= htmlspecialchars($s['stdNo']) ?>">
                      <?php hidden_keep_fields(['lang', 'theme', 'view', 'sort', 'dir', 'q', 'grade']); ?>
                      <button class="btn btn-sm btn-outline-danger"><?= htmlspecialchars($T[$lang]['delete']) ?></button>
                    </form>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
        <div class="text-center fw-bold py-2"><?= htmlspecialchars($T[$lang]['studentsNum']) ?>: <?= $count ?></div>
      </div>
    <?php endif; ?>

  </div>
</body>


</html>
