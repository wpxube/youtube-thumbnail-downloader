<?php
  if(isset($_POST['button'])){
    $imgUrl = $_POST['imgurl'];
    $ch = curl_init($imgUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $downloadImg = curl_exec($ch);
    curl_close($ch);
    header('Content-type: image/jpg');
    header('Content-Disposition: attachment;filename="thumbnail.jpg"');
    echo $downloadImg;
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="shortcut icon" href="favicon.png" type="image/x-icon">
  <link rel="prefetch" href="//cdnjs.cloudflare.com">
  <link rel="prefetch" href="//fonts.gstatic.com">
  <link rel="prefetch" href="//fonts.googleapis.com">
  <meta charset="UTF-8">
  <link rel="canonical" href="#"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Youtube Video Thumbnail Downloader</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
</head>
<body><a href="https://github.com/wpxube/youtube-thumbnail-downloader/" class="github-corner" aria-label="View source on GitHub"><svg width="80" height="80" viewBox="0 0 250 250" style="fill:#151513; color:#fff; position: absolute; top: 0; border: 0; right: 0;" aria-hidden="true"><path d="M0,0 L115,115 L130,115 L142,142 L250,250 L250,0 Z"></path><path d="M128.3,109.0 C113.8,99.7 119.0,89.6 119.0,89.6 C122.0,82.7 120.5,78.6 120.5,78.6 C119.2,72.0 123.4,76.3 123.4,76.3 C127.3,80.9 125.5,87.3 125.5,87.3 C122.9,97.6 130.6,101.9 134.4,103.2" fill="currentColor" style="transform-origin: 130px 106px;" class="octo-arm"></path><path d="M115.0,115.0 C114.9,115.1 118.7,116.5 119.8,115.4 L133.7,101.6 C136.9,99.2 139.9,98.4 142.2,98.6 C133.8,88.0 127.5,74.4 143.8,58.0 C148.5,53.4 154.0,51.2 159.7,51.0 C160.3,49.4 163.2,43.6 171.4,40.1 C171.4,40.1 176.1,42.5 178.8,56.2 C183.1,58.6 187.2,61.8 190.9,65.4 C194.5,69.0 197.7,73.2 200.1,77.6 C213.8,80.2 216.3,84.9 216.3,84.9 C212.7,93.1 206.9,96.0 205.4,96.6 C205.1,102.4 203.0,107.8 198.3,112.5 C181.9,128.9 168.3,122.5 157.7,114.1 C157.9,116.9 156.7,120.9 152.7,124.9 L141.0,136.5 C139.8,137.7 141.6,141.9 141.8,141.8 Z" fill="currentColor" class="octo-body"></path></svg></a><style>.github-corner:hover .octo-arm{animation:octocat-wave 560ms ease-in-out}@keyframes octocat-wave{0%,100%{transform:rotate(0)}20%,60%{transform:rotate(-25deg)}40%,80%{transform:rotate(10deg)}}@media (max-width:500px){.github-corner:hover .octo-arm{animation:none}.github-corner .octo-arm{animation:octocat-wave 560ms ease-in-out}}</style>
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
  <center><a href="https://wpxube.com"><img src="logo.png" style="height:40px;width:150px;" alt="WpXube"></a></center>
    <header>Download YT Thumbnail</header>
    <div class="url-input">
      <center><span class="title">Paste Video Url</span></center>
      <div class="field">
        <input type="text" placeholder="https://www.youtube.com/watch?v=CXlGgf6bCA8" required>
        <input class="hidden-input" type="hidden" name="imgurl">
        <span class="bottom-line"></span>
      </div>
    </div>
    <div class="preview-area">
      <img class="thumbnail" src="" alt="Thumbnail">
      <i class="icon fas fa-cloud-download-alt"></i>
      <span>Paste Url To Fetch Preview</span>
    </div>
    <button class="download-btn" type="submit" name="button">Download Thumbnail</button>
    <center><p style="font-family: "Poppins", sans-serif;"><i class="far fa-copyright"></i> Powered By <a href="https://wpxube.com">WpXube</a>. Made With <i class="fas fa-heart"></i>.</p></center>
  </form>
  <script type="module">
    const urlField = document.querySelector(".field input"),
    previewArea = document.querySelector(".preview-area"),
    imgTag = previewArea.querySelector(".thumbnail"),
    hiddenInput = document.querySelector(".hidden-input"),
    button = document.querySelector(".download-btn");

    urlField.onkeyup = ()=>{
      let imgUrl = urlField.value;
      previewArea.classList.add("active");
      button.style.pointerEvents = "auto";
      if(imgUrl.indexOf("https://www.youtube.com/watch?v=") != -1){
        let vidId = imgUrl.split('v=')[1].substring(0, 11);
        let ytImgUrl = `https://img.youtube.com/vi/${vidId}/maxresdefault.jpg`;
        imgTag.src = ytImgUrl;
      }else if(imgUrl.indexOf("https://youtu.be/") != -1){
        let vidId = imgUrl.split('be/')[1].substring(0, 11);
        let ytImgUrl = `https://img.youtube.com/vi/${vidId}/maxresdefault.jpg`;
        imgTag.src = ytImgUrl;
      }else if(imgUrl.match(/\.(jpe?g|png|gif|bmp|webp)$/i)){
        imgTag.src = imgUrl;
      }else{
        imgTag.src = "";
        button.style.pointerEvents = "none";
        previewArea.classList.remove("active");
      }
      hiddenInput.value = imgTag.src;
    }
  </script>
</body>
</html>
