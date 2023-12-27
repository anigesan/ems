<?php
include('session.php');

// Memeriksa apakah pengguna adalah admin atau guest
if ($_SESSION['role'] !== 'admin' && $_SESSION['role'] !== 'guest') {
    header("Location: haha.php");
    exit();
}
$result = $db;

if (!$result) {
    die("Error: " . mysqli_error($db));
}
?>

<!-- Headers Start -->
<?php include 'index-layouts/header.php'; ?>
<!-- Headers End -->

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>University Event</title>
  <style>
    body { margin: 0; }
    canvas { display: block; }
  </style>
</head>
<body>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
  <script src="https://threejs.org/examples/js/loaders/GLTFLoader.js"></script>

  <script>
    const scene = new THREE.Scene();
    const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
    const renderer = new THREE.WebGLRenderer();
    renderer.setSize(window.innerWidth, window.innerHeight);
    document.body.appendChild(renderer.domElement);

    const loader = new THREE.GLTFLoader();

    let lemari;

    loader.load('../ems/img/cabinet.glb', (gltf) => {
      lemari = gltf.scene;
      scene.add(lemari);
    });

    const ambientLight = new THREE.AmbientLight(0xffffff, 0.5);
    scene.add(ambientLight);

    camera.position.z = 5;

    const onObjectClick = () => {
      alert("Keterangan: Achievement University");
    };

    const raycaster = new THREE.Raycaster();
    const mouse = new THREE.Vector2();

    document.addEventListener('click', (event) => {
      event.preventDefault();

      mouse.x = (event.clientX / window.innerWidth) * 2 - 1;
      mouse.y = - (event.clientY / window.innerHeight) * 2 + 1;

      raycaster.setFromCamera(mouse, camera);

      const intersects = raycaster.intersectObjects(scene.children, true);

      if (intersects.length > 0) {
        if (intersects[0].object === lemari) {
          onObjectClick();
        }
      }
    });

    const animate = () => {
      requestAnimationFrame(animate);
      renderer.render(scene, camera);
    };

    animate();
  </script>
</body>
</html>

<!-- Headers Start -->
<?php include 'index-layouts/footer.php'; ?>
<!-- Headers End -->
