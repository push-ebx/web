<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Искусство и культура</title>
  <link rel="stylesheet" href="./globals.css">
</head>
<style>
  .subject-area {
    margin-bottom: 40px;
  }

  .subject-area img {
    max-width: 20vw;
    height: auto;
    display: block;
    margin-top: 20px;
  }

  section {
    width: 820px;
    display: flex;
    justify-content: space-between;
    column-gap: 20px;
    align-items: center;
    line-height: 150%;
  }

  section p {
    font-size: 20px;
  }

  #description::first-letter {
    color: #f74646;
    font-size: 45px;
  }

  section div {
    display: flex;
    flex-direction: column;
  }

  main {
    width: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 100px 0;
  }

  #description {
    font-size: 20px;
    text-align: justify;
    margin: 50px 0;
  }
</style>

<body>
  <header>
    <h1><a href="/">Искусство и культура</a></h1>
    <div>
      <a href="/dashboard">Личный кабинет</a>
      <a href="/gallery.php">Галерея</a>
    </div>
  </header>
  <main>
    <section>
      <p id="description">Искусство и культура являются неотъемлемой частью человеческого общества. Они вдохновляют, пленяют, обогащают и олицетворяют множество аспектов нашей жизни. На этой странице вы найдете информацию о художниках, произведениях искусства, музеях, оценках критиков и многом другом.</p>
    </section>
    <section class="subject-area">
      <div>
        <h2>Авторы</h2>
        <p>Здесь вы найдете информацию о творческих деятелях - художниках, скульпторах, архитекторах и прочих мастерах искусства.</p>
      </div>
      <img src="https://arthive.net/res/media/img/oy1000/work/696/297196@2x.jpg" alt="Авторы">
    </section>

    <section class="subject-area">
      <div>
        <h2>Произведения искусства</h2>
        <p>Этот раздел содержит информацию о знаменитых произведениях искусства, их истории, авторах и техниках исполнения.</p>
      </div>
      <img src="https://www.hse.ru/data/2017/05/17/1171369516/zvezdnoe_nebo.jpeg" alt="Произведения искусства">
    </section>

    <section class="subject-area">
      <div>
        <h2>Музеи</h2>
        <p>Музеи - это места, где хранится и экспонируется ценное искусство. В этом разделе вы узнаете о самых известных музеях мира.</p>
      </div>
      <img src="https://u.livelib.ru/reader/boservas/o/ua4yfi3t/112-o.jpeg" alt="Музеи">
    </section>

    <section class="subject-area">
      <div>
        <h2>Критики</h2>
        <p>Критики искусства анализируют и оценивают произведения искусства. В этом разделе вы найдете информацию о самых авторитетных критиках.</p>
      </div>
      <img src="https://cdn-static.artguide.com/storage/post/541/wide_detail_picture.jpg" alt="Критики">
    </section>
  </main>

  <footer>
    <a href="/dashboard">Личный кабинет</a>
    <a href="/gallery.php">Галерея</a>
  </footer>
</body>

</html>