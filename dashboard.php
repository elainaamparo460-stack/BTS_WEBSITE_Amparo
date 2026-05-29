```php id="r5g6gg"
<?php

session_start();

if(!isset($_SESSION['username'])){
    header("Location: login.php");
    exit();
}

include "conn.php";

$admin = $_SESSION['username'];

$openPage = isset($_GET['page']) ? $_GET['page'] : 'dashboard';
$flashMsg = isset($_GET['msg']) ? $_GET['msg'] : '';

$cnt = [];

foreach(['members','albums','videos','tinytan','member_album'] as $tbl){

    $r = mysqli_query($conn,"SELECT COUNT(*) as c FROM $tbl");

    $cnt[$tbl] = $r ? mysqli_fetch_assoc($r)['c'] : 0;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>BTS Universe — Admin</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

<link rel="stylesheet" href="d.css">
</head>
<body>

<div id="toast">
  <i class="fa-solid fa-circle-check" style="color:#10b981;font-size:16px;"></i>
  <span id="toastMsg"></span>
</div>

<aside class="sidebar" id="sidebar">

  <div class="sidebar-brand">
    <img src="img/logo.png" alt="Logo">
    <span>BTS <b>ADMIN</b></span>
  </div>

  <nav class="sidebar-nav">

    <div class="nav-section">MAIN</div>

    <a class="nav-item" onclick="showPage('dashboard',this)">
      <i class="fa-solid fa-gauge-high"></i> BTS Dashboard
    </a>

    <div class="nav-section">CONTENT</div>

    <a class="nav-item" onclick="showPage('members',this)">
      <i class="fa-solid fa-users"></i> Members
    </a>

    <a class="nav-item" onclick="showPage('discography',this)">
      <i class="fa-solid fa-compact-disc"></i> Discography
    </a>

    <a class="nav-item" onclick="showPage('videos',this)">
      <i class="fa-solid fa-film"></i> Videos
    </a>

    <a class="nav-item" onclick="showPage('tinytan',this)">
      <i class="fa-solid fa-star"></i> TinyTan
    </a>

  <a class="nav-item" onclick="showPage('member_album',this)">
    <i class="fa-solid fa-images"></i> Member Album
</a>

    <div class="nav-section">SYSTEM</div>

    <a class="nav-item" onclick="showPage('accounts',this)">
      <i class="fa-solid fa-user-shield"></i> Accounts
    </a>


  </nav>

  <div class="sidebar-footer">
    <div class="admin-profile">
      <div class="admin-avatar"><?php echo strtoupper(substr($admin,0,1)); ?></div>
      <div class="admin-info">
        <small>LOGGED IN AS</small>
        <span><?php echo htmlspecialchars($admin); ?></span>
      </div>
    <a href="logout.php" class="logout-btn"
onclick="return confirm('Logout your account?')">

  <i class="fa-solid fa-right-from-bracket"></i>
  Logout

</a>

</aside>

<div class="main">

<div class="topbar">

  <div class="topbar-left">
    <button class="sidebar-toggle" id="sidebarToggle">
      <i class="fa-solid fa-bars"></i>
    </button>

    <div class="topbar-title" id="pageTitle">
      BTS DASHBOARD
    </div>
  </div>

  <div class="topbar-right">

    <form action="search.php" method="POST" class="search-form">

      <div class="search-icon">
        <i class="fa-solid fa-magnifying-glass"></i>
      </div>

      <input
        type="text"
        name="key"
        class="search-input"
        placeholder="Search members, albums, videos..."
        required
      >

      <button type="submit" class="search-btn">
        SEARCH
      </button>

    </form>

    <a href="/BTS_WEBSITE/index.php" target="_blank" class="topbar-site-btn">
      <i class="fa-solid fa-arrow-up-right-from-square"></i> VIEW SITE
    </a>

  </div>

</div>
  <div class="content">

<div class="page" id="dashboard">

  <div class="welcome-banner">

    <div class="welcome-text">
      <h2>
        Hello World,
      </h2>
      <p>
        Ready to update the BTS Universe today?
      </p>
    </div>

    <img src="img/logo.png" class="welcome-logo" alt="BTS Logo">

  </div>

  <div class="row g-4 mb-4">

    <div class="col-6 col-lg-3">
      <div class="stat-card">

        <div class="stat-icon purple">
          <i class="fa-solid fa-users"></i>
        </div>

        <div class="stat-info">
          <small>MEMBERS</small>
          <h3><?php echo $cnt['members']; ?></h3>
        </div>

      </div>
    </div>

    <div class="col-6 col-lg-3">
      <div class="stat-card">

        <div class="stat-icon pink">
          <i class="fa-solid fa-compact-disc"></i>
        </div>

        <div class="stat-info">
          <small>ALBUMS</small>
          <h3><?php echo $cnt['albums']; ?></h3>
        </div>

      </div>
    </div>

    <div class="col-6 col-lg-3">
      <div class="stat-card">

        <div class="stat-icon blue">
          <i class="fa-solid fa-film"></i>
        </div>

        <div class="stat-info">
          <small>VIDEOS</small>
          <h3><?php echo $cnt['videos']; ?></h3>
        </div>

      </div>
    </div>

    <div class="col-6 col-lg-3">
      <div class="stat-card">

        <div class="stat-icon green">
          <i class="fa-solid fa-star"></i>
        </div>

        <div class="stat-info">
          <small>TINYTAN</small>
          <h3><?php echo $cnt['tinytan']; ?></h3>
        </div>

      </div>
    </div>

  </div>

  <div class="section-card">

    <div class="section-card-header">
      <h5>
        <i class="fa-solid fa-bolt me-2"
           style="color:var(--purple-light)">
        </i>

        QUICK ACTIONS
      </h5>
    </div>

    <div class="row g-4">

      <div class="col-6 col-md-3">
        <a href="add.php?type=members" class="quick-btn">

          <div class="quick-icon">
            <i class="fa-solid fa-user-plus"></i>
          </div>

          <span>ADD MEMBER</span>

        </a>
      </div>


      <div class="col-6 col-md-3">
        <a href="add.php?type=albums" class="quick-btn">

          <div class="quick-icon">
            <i class="fa-solid fa-compact-disc"></i>
          </div>

          <span>ADD ALBUM</span>

        </a>
      </div>


      <div class="col-6 col-md-3">
        <a href="add.php?type=videos" class="quick-btn">

          <div class="quick-icon">
            <i class="fa-solid fa-video"></i>
          </div>

          <span>ADD VIDEO</span>

        </a>
      </div>


      <div class="col-6 col-md-3">
        <a href="add.php?type=tinytan" class="quick-btn">

          <div class="quick-icon">
            <i class="fa-solid fa-wand-magic-sparkles"></i>
          </div>

          <span>ADD TINYTAN</span>

        </a>
      </div>

      <div class="col-6 col-md-3 d-flex">
  <a href="add.php?type=member_album" class="quick-btn w-100">
    <i class="fa-solid fa-images"></i>
    <span>ADD PHOTO</span>
  </a>
</div>

    </div>

  </div>

</div>
    </div>

<div class="page" id="members">
  <div class="section-card">
    <div class="section-card-header">
      <h5><i class="fa-solid fa-users me-2" style="color:var(--purple-light)"></i>BTS MEMBERS</h5>
      <a href="add.php?type=members" class="add-btn"><i class="fa-solid fa-plus"></i> ADD MEMBER</a>
    </div>

    <div class="table-responsive">
      <table class="table align-middle mb-0">
        <thead>
          <tr>
            <th>#</th>
            <th>Stage Name</th>
            <th>Real Name</th>
            <th>Position</th>
            <th>Birthday</th>
            <th>Actions</th>
          </tr>
        </thead>

        <tbody>
          <?php
          $members = mysqli_query($conn,"SELECT * FROM members ORDER BY id ASC");

          if($members && mysqli_num_rows($members) > 0):
            $i = 1;

            while($m = mysqli_fetch_assoc($members)):
          ?>
          <tr>
            <td><?php echo $i++; ?></td>
            <td><b><?php echo htmlspecialchars($m['stage_name']); ?></b></td>
            <td><?php echo htmlspecialchars($m['real_name']); ?></td>
            <td><span class="badge-purple"><?php echo htmlspecialchars($m['position']); ?></span></td>

            <td>
              <?php echo htmlspecialchars($m['birthday'] ?? 'N/A'); ?>
            </td>

            <td>
              <a href="edit.php?type=members&id=<?php echo $m['id']; ?>" class="action-btn edit-btn me-1">
                <i class="fa-solid fa-pen"></i>
              </a>

              <a href="delete.php?type=members&id=<?php echo $m['id']; ?>" class="action-btn delete-btn"
                 onclick="return confirm('Delete <?php echo htmlspecialchars($m['stage_name']); ?>?')">
                <i class="fa-solid fa-trash"></i>
              </a>
            </td>
          </tr>
          <?php
            endwhile;
          else:
          ?>

          <tr>
            <td colspan="6" class="text-center text-muted py-4">No members found.</td>
          </tr>
          <?php endif; ?>
        </tbody>

      </table>
    </div>
  </div>
</div>
<div class="page" id="discography">

  <div class="section-card">

    <div class="section-card-header">
      <h5>
        <i class="fa-solid fa-compact-disc me-2" style="color:var(--purple-light)"></i>
        DISCOGRAPHY
      </h5>

      <a href="add.php?type=albums" class="add-btn">
        <i class="fa-solid fa-plus"></i> ADD ALBUM
      </a>
    </div>

    <div class="table-responsive">

      <table class="table align-middle mb-0">

        <thead>
          <tr>
            <th>#</th>
            <th>Album Title</th>
            <th>Year</th>
            <th>Spotify</th>
            <th>Actions</th>
          </tr>
        </thead>

        <tbody>

          <?php
          $albums = mysqli_query($conn, "SELECT * FROM albums ORDER BY release_year DESC");

          if($albums && mysqli_num_rows($albums) > 0):

            $i = 1;

            while($a = mysqli_fetch_assoc($albums)):
          ?>

          <tr>

            <td><?php echo $i++; ?></td>

            <td>
              <b><?php echo htmlspecialchars($a['title']); ?></b>
            </td>

            <td>
              <?php echo htmlspecialchars($a['release_year']); ?>
            </td>

            <td>
              <?php if(!empty($a['spotify_link'])): ?>
                <a href="<?php echo htmlspecialchars($a['spotify_link']); ?>" target="_blank">
                  Open Link
                </a>
              <?php else: ?>
                N/A
              <?php endif; ?>
            </td>

            <td>

              <a href="edit.php?type=albums&id=<?php echo $a['album_id']; ?>" class="action-btn edit-btn me-1">
                <i class="fa-solid fa-pen"></i>
              </a>

              <a href="delete.php?type=albums&id=<?php echo $a['album_id']; ?>" class="action-btn delete-btn"
                 onclick="return confirm('Delete <?php echo htmlspecialchars($a['title']); ?>?')">
                <i class="fa-solid fa-trash"></i>
              </a>

            </td>

          </tr>

          <?php
            endwhile;

          else:
          ?>

          <tr>
            <td colspan="5" class="text-center text-muted py-4">
              No albums found.
            </td>
          </tr>

          <?php endif; ?>

        </tbody>

      </table>

    </div>

  </div>

</div>
    <div class="page" id="videos">
      <div class="section-card">
        <div class="section-card-header">
          <h5><i class="fa-solid fa-film me-2" style="color:var(--purple-light)"></i>VIDEOS</h5>
          <a href="add.php?type=videos" class="add-btn"><i class="fa-solid fa-plus"></i> ADD VIDEO</a>
        </div>
        <div class="table-responsive">
          <table class="table align-middle mb-0">
            <thead>
              <tr>
                <th>#</th>
                <th>Title</th>
                <th>Category</th>
                <th>Year</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $videos = mysqli_query($conn,"SELECT * FROM videos ORDER BY year DESC");
              if($videos && mysqli_num_rows($videos) > 0):
                $i = 1;
                while($v = mysqli_fetch_assoc($videos)):
              ?>
              <tr>
                <td><?php echo $i++; ?></td>
                <td><b><?php echo htmlspecialchars($v['title']); ?></b></td>
                <td><span class="badge-blue"><?php echo htmlspecialchars($v['category']); ?></span></td>
                <td><?php echo htmlspecialchars($v['year']); ?></td>
                <td>
                  <a href="edit.php?type=videos&id=<?php echo $v['id']; ?>" class="action-btn edit-btn me-1"><i class="fa-solid fa-pen"></i></a>
                  <a href="delete.php?type=videos&id=<?php echo $v['id']; ?>" class="action-btn delete-btn" onclick="return confirm('Delete <?php echo htmlspecialchars($v['title']); ?>?')"><i class="fa-solid fa-trash"></i></a>
                </td>
              </tr>
              <?php endwhile; else: ?>
              <tr><td colspan="5" class="text-center text-muted py-4">No videos found.</td></tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <div class="page" id="tinytan">
      <div class="section-card">
        <div class="section-card-header">
          <h5><i class="fa-solid fa-star me-2" style="color:var(--purple-light)"></i>TINYTAN</h5>
          <a href="add.php?type=tinytan" class="add-btn"><i class="fa-solid fa-plus"></i> ADD TINYTAN</a>
        </div>
        <div class="table-responsive">
          <table class="table align-middle mb-0">
            <thead>
              <tr>
                <th>#</th>
                <th>Character</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $tinytan = mysqli_query($conn,"SELECT * FROM tinytan ORDER BY id ASC");
              if($tinytan && mysqli_num_rows($tinytan) > 0):
                $i = 1;
                while($t = mysqli_fetch_assoc($tinytan)):
              ?>
              <tr>
                <td><?php echo $i++; ?></td>
                <td><b><?php echo htmlspecialchars($t['character_name']); ?></b></td>
                <td>
                  <a href="edit.php?type=tinytan&id=<?php echo $t['id']; ?>" class="action-btn edit-btn me-1"><i class="fa-solid fa-pen"></i></a>
                  <a href="delete.php?type=tinytan&id=<?php echo $t['id']; ?>" class="action-btn delete-btn" onclick="return confirm('Delete <?php echo htmlspecialchars($t['character_name']); ?>?')"><i class="fa-solid fa-trash"></i></a>
                </td>
              </tr>
              <?php endwhile; else: ?>
              <tr><td colspan="4" class="text-center text-muted py-4">No TinyTan characters found.</td></tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
<div class="page" id="member_album">

  <div class="section-card">

    <div class="section-card-header">

      <h5>
        <i class="fa-solid fa-images me-2"
        style="color:var(--purple-light)"></i>

        MEMBER ALBUM
      </h5>

      <a href="add.php?type=member_album" class="add-btn">
        <i class="fa-solid fa-plus"></i>
        ADD PHOTO
      </a>

    </div>

    <div class="table-responsive">

      <table class="table align-middle mb-0">

        <thead>
          <tr>
            <th>#</th>
            <th>Photo</th>
            <th>Actions</th>
          </tr>
        </thead>

        <tbody>

<?php
          $albumPhotos = mysqli_query(
              $conn,
              "SELECT * FROM member_album ORDER BY album_id DESC"
          );

          if($albumPhotos && mysqli_num_rows($albumPhotos) > 0):

          $i = 1;

          while($p = mysqli_fetch_assoc($albumPhotos)):
          ?>

          <tr>
          <td><?php echo $i++; ?></td>
          <td>

          <img
          src="album/<?php echo htmlspecialchars($p['image']); ?>"
          style="
          width:90px;
          height:90px;
          object-fit:cover;
          border-radius:14px;
          border:2px solid #eee;
          " >

          </td>

          <td>

          <a
          href="delete.php?type=member_album&id=<?php echo $p['album_id']; ?>"
          class="action-btn delete-btn"
          onclick="return confirm('Delete this photo?')">

          <i class="fa-solid fa-trash"></i>

          </a>

          </td>

          </tr>

          <?php
          endwhile;

          else:
          ?>

          <tr>
          <td colspan="3"
          class="text-center text-muted py-4">

          No photos found.

          </td>
          </tr>

          <?php endif; ?>

                  </tbody>

                </table>

              </div>

            </div>

          </div>

    <div class="page" id="accounts">
      <div class="section-card">
        <div class="section-card-header">
          <h5><i class="fa-solid fa-user-shield me-2" style="color:var(--purple-light)"></i>ADMIN ACCOUNTS</h5>
          <a href="add.php?type=accounts" class="add-btn"><i class="fa-solid fa-plus"></i> ADD ACCOUNT</a>
        </div>
        <div class="table-responsive">
          <table class="table align-middle mb-0">
            <thead>
              <tr>
                <th>#</th>
                <th>Username</th>
                <th>Full Name</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $accounts = mysqli_query($conn,"SELECT * FROM users ORDER BY id ASC");
              if($accounts && mysqli_num_rows($accounts) > 0):
                $i = 1;
                while($u = mysqli_fetch_assoc($accounts)):
              ?>
              <tr>
                <td><?php echo $i++; ?></td>
                <td><b><?php echo htmlspecialchars($u['username']); ?></b></td>
                <td><?php echo htmlspecialchars(trim($u['fname'].' '.$u['mname'].' '.$u['lname'])); ?></td>
                <td>
                  <a href="delete.php?type=accounts&id=<?php echo $u['id']; ?>" class="action-btn delete-btn" onclick="return confirm('Delete account <?php echo htmlspecialchars($u['username']); ?>?')"><i class="fa-solid fa-trash"></i></a>
                </td>
              </tr>
              <?php endwhile; else: ?>
              <tr><td colspan="4" class="text-center text-muted py-4">No accounts found.</td></tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

  </div>
              </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
<script>


function showPage(page, el){

  document.querySelectorAll('.page').forEach(p => p.classList.remove('active'));
  document.getElementById(page).classList.add('active');

  document.querySelectorAll('.nav-item').forEach(n => n.classList.remove('active'));
  if(el) el.classList.add('active');

  document.getElementById('pageTitle').innerText = page.toUpperCase();
  document.getElementById('sidebar').classList.remove('open');
}

const openPage = "<?php echo htmlspecialchars($openPage); ?>";
const navItems = document.querySelectorAll('.nav-item');
let matched = null;
navItems.forEach(el => {
  const fn = el.getAttribute('onclick') || '';
  if(fn.includes("'" + openPage + "'") || fn.includes('"' + openPage + '"')) matched = el;
});
showPage(openPage, matched);

const flashMsg = "<?php echo addslashes(htmlspecialchars($flashMsg)); ?>";
if(flashMsg){
  const toast = document.getElementById('toast');
  document.getElementById('toastMsg').textContent = flashMsg;
  toast.style.display = 'flex';
  setTimeout(() => {
    toast.style.transition = '0.5s';
    toast.style.opacity = '0';
    setTimeout(() => { toast.style.display = 'none'; toast.style.opacity = '1'; }, 500);
  }, 3500);
}

document.getElementById('sidebarToggle').onclick = () => {
  document.getElementById('sidebar').classList.toggle('open');
};

document.body.style.opacity = "0";
window.onload = () => {
  document.body.style.transition = "0.6s ease";
  document.body.style.opacity = "1";
};

</script>
</body>
</html>