<?php
session_start();
require_once 'db_connect.php'; // DB接続ファイルを読み込む

$brands = [];
$user_id = null;

// ログインしている場合、お気に入りブランドを取得
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $stmt = $pdo->prepare("
        SELECT b.id, b.name 
        FROM favorite_brands fb
        JOIN brands b ON fb.brand_id = b.id
        WHERE fb.user_id = ?
    ");
    $stmt->execute([$user_id]);
    $brands = $stmt->fetchAll(PDO::FETCH_ASSOC);
}?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>fitty. | プライバシーポリシー</title>
    <link rel="stylesheet" href="../CSS/reset.css">
    <link rel="stylesheet" href="../CSS/common.css">
    <link rel="stylesheet" href="../CSS/privacy.css">
</head>
<body>
  <!-- headerここから -->
<header class="header">
    <button class="menu_button" id="menuToggle" aria-label="メニューを開閉" aria-expanded="false" aria-controls="globalMenu">
        <span class="bar"></span><span class="bar"></span><span class="bar"></span>
    </button>
    <div class="header_logo">
        <h1><a href="./index.php">fitty.</a></h1>
    </div>
    <nav class="header_nav"> 
            <nav class="header_nav"> <?php
    if (isset($_SESSION['user_id'])) {
        echo '<div class="login_logout_img">
  <a href="logout.php">
    <img src="./img/logout.jpg" alt="ログアウト">
  </a>
</div>
';
    } else {
        echo '<div class="login_logout_img">
  <a href="login.php">
    <img src="./img/login.png" alt="ログイン">
  </a>
</div>
';
    }?>
        <a href="./mypage.php" class="icon-user" title="マイページ">👤</a> 
        <a href="./cart.php" class="icon-cart" title="カート">🛒</a> 
        <a href="./search.php" class="icon-search" title="検索">🔍</a> 
        <a href="./contact.php" class="icon-contact" title="お問い合わせ">✉️</a> 
    </nav>
</header>

<div class="backdrop" id="menuBackdrop"></div>

<?php if ($user_id): ?>
<div class="menu_overlay" id="globalMenu" role="navigation" aria-hidden="true">
    <nav>
        <?php if (!empty($brands)): ?>
            <?php foreach ($brands as $index => $brand): ?>
                <a href="brand.php?id=<?= htmlspecialchars($brand['id']) ?>"
                   role="menuitem"
                   class="bland"
                   style="--index: <?= $index ?>; top: <?= 75 + $index * 50 ?>px; left: <?= 170 - $index * 60 ?>px;">
                    <?= htmlspecialchars($brand['name']) ?>
                </a>
            <?php endforeach; ?>
        <?php else: ?>
            <p style="padding: 10px; margin-top:65px;">お気に入りのブランドが登録されていません。</p>
        <?php endif; ?>
    </nav>
</div>
<?php endif; ?>

<div class="backdrop" id="menuBackdrop"></div>

<?php if (isset($_SESSION['user_id'])): ?>
<div class="menu_overlay" id="globalMenu" role="navigation" aria-hidden="true">
  <nav>
    <?php if (!empty($brands)): ?>
      <?php foreach ($brands as $index => $brand): ?>
        <a href="brand.php?id=<?= htmlspecialchars($brand['id']) ?>"
   role="menuitem"
   class="brand">
  <?= htmlspecialchars($brand['name']) ?>
</a>

      <?php endforeach; ?>
    <?php else: ?>
      <p style="padding: 10px;">お気に入りのブランドが登録されていません。</p>
    <?php endif; ?>
  </nav>
</div>
<?php endif; ?>

<div class="header_space"></div>
  <!-- headerここまで -->
    <main>
    <h1 id="title">プライバシーポリシー</h1>
    <p>株式会社fitty.（以下「当社」といいます）は、当社が運営するファッションECサイト「fitty.」（以下「本サイト」といいます）における個人情報の取り扱いについて、以下のとおりプライバシーポリシーを定めます。</p>
    
    <h2 class="subtitle">第1条（個人情報の定義）</h2>
    <p>本プライバシーポリシーにおける個人情報とは、生存する個人に関する情報であって、氏名、住所、電話番号、メールアドレス、その他特定の個人を識別できる情報を指します。</p>
    
    <h2 class="subtitle">第2条（個人情報の収集方法）</h2>
    <p>当社は、会員登録、商品の購入、問い合わせなどの際に、必要な範囲で個人情報を適法かつ公正な手段により収集いたします。</p>
    
    <h2 class="subtitle">第3条（個人情報の利用目的）</h2>
    <p>当社は収集した個人情報を以下の目的で利用いたします。</p>
    <ul>
      <li>商品の発送および決済処理</li>
      <li>会員管理および本人確認</li>
      <li>お問い合わせ対応および連絡</li>
      <li>サービス向上のための分析やマーケティング</li>
      <li>法令等に基づく対応</li>
    </ul>
    
    <h2 class="subtitle">第4条（個人情報の第三者提供）</h2>
    <p>当社は、法令に定める場合を除き、本人の同意なく第三者に個人情報を提供いたしません。ただし、業務委託先に業務遂行のため必要な範囲で提供する場合があります。</p>
    
    <h2 class="subtitle">第5条（個人情報の安全管理）</h2>
    <p>当社は個人情報の漏えい、滅失、毀損を防止するため、適切な安全管理措置を講じます。</p>
    
    <h2 class="subtitle">第6条（個人情報の開示・訂正・利用停止等）</h2>
    <p>利用者は当社に対し、自己の個人情報の開示、訂正、追加、削除、利用停止等を求めることができます。対応方法については当社のお問い合わせ窓口にご連絡ください。</p>
    
    <h2 class="subtitle">第7条（クッキー（Cookie）について）</h2>
    <p>当サイトではサービス向上のためクッキーを使用することがあります。クッキーにより収集される情報は個人を特定できるものではありません。</p>
    
    <h2 class="subtitle">第8条（プライバシーポリシーの変更）</h2>
    <p>当社は必要に応じて本プライバシーポリシーを変更することがあります。変更後の内容は当サイトに掲示した時点で効力を生じます。</p>
    
    <h2 class="subtitle">第9条（お問い合わせ窓口）</h2>
    <p>本ポリシーに関するお問い合わせは、以下の窓口までお願いいたします。</p>
    <p>株式会社fitty. お問い合わせ窓口<br />
    住所：東京都〇〇区〇〇1-1-11<br />
    メール：contact@fitty.example.jp<br />
    電話番号：03-1234-5678</p>
    
    <p id="end">以上</p>
  </main>
<!-- フッターここから -->
 <footer class="footer">
    <div class="footer_container">
        <a href="index.php"><div class="footer_logo"><h2>fitty.</h2></div></a>
        <div class="footer_links">
            <a href="./overview.php">会社概要</a>
            <a href="./terms.php">利用規約</a>
            <a href="./privacy.php">プライバシーポリシー</a>
            <a href="./qa.php">よくある質問</a>
        </div>
        <div class="footer_sns">
            <a href="#"><img src="img/sns_icon/twitter.png" alt="Twitter"><a>
            <a href="#"><img src="img/sns_icon/instagram.png" alt="Instagram"><a>
            <a href="#"><img src="img/sns_icon/youtube.png" alt="YouTube"><a>
        </div>
        <div class="footer_copy">
            <small>&copy; 2025 Fitty All rights reserved.</small>
        </div>
    </div>
</footer>
<!-- フッターここまで -->
   <script src="../JavaScript/hamburger.js"></script>
</body>
</html>