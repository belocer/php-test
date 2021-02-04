<?php // Главная страница сайта
require_once 'header.php';

/*echo '<pre>';
print_r(get_defined_vars());
echo '</pre>';*/
/*echo '<pre>';
print_r($data);
echo '</pre>';*/
?>

    <div class="wrapper">

        <!-- START Post-->
        <section class="post">
            <h1 class="post__header">Пост 2021</h1>
            <div class="post__text-container">
                <div class="wrap_img">
                    <img src="https://picsum.photos/300/400" alt="https://picsum.photos/200/300">
                </div>
                <div class="post__text">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid nihil, odio perferendis rerum
                        tempore voluptatibus?
                        Aliquid asperiores assumenda autem dolores doloribus ipsa non officia quod. Blanditiis eos neque
                        non officia.</p>
                    <br>
                    <p>Ab accusantium ad dignissimos distinctio eveniet exercitationem fugit id, impedit ipsam laborum
                        minus modi nam natus
                        praesentium provident quo sed veritatis vitae! Adipisci assumenda ea libero minima pariatur
                        vitae. Quo.</p>
                    <br>
                    <p>Aliquid assumenda commodi dolor doloribus eos excepturi illo impedit perspiciatis vel, veritatis?
                        Alias aliquam,
                        at consequuntur dolore, ea eligendi itaque minus modi natus, possimus quibusdam reprehenderit
                        repudiandae saepe sunt
                        voluptas.</p>
                    <br>
                    <p>Asperiores cupiditate dignissimos, error esse expedita nobis nostrum quod repudiandae tenetur
                        vero. Accusamus amet
                        aperiam cumque delectus esse est, eveniet, ipsa itaque numquam officiis sunt tenetur ullam ut
                        veniam voluptas?</p>
                </div>
            </div>
        </section>
        <!-- END Post-->

        <hr>

        <!-- START Form comment-->
        <section class="comment">
            <form action="#" class="form">
                <h2 class="form__header">Написать комментарий: </h2>
                <div class="form__group">
                    <label for="user_name" class="form__label">Имя</label>
                    <input type="text" id="user_name" name="user_name" class="form__input">
                </div>

                <div class="form__group">
                    <label for="user_email" class="form__label">E-mail</label>
                    <input type="text" id="user_email" name="user_email" class="form__input">
                </div>

                <div class="form__group">
                    <label for="comment_title" class="form__label">Заголовок комментария</label>
                    <input type="text" id="comment_title" name="comment_title" class="form__input">
                </div>

                <div class="form__group">
                    <label for="comment_text" class="form__label">Комментарий</label>
                    <textarea id="comment_text" name="comment_text" rows="4" class="form__textarea"></textarea>
                </div>

                <button type="submit" class="form__btn">Отправить</button>
            </form>
        </section>
        <!-- END Form comment-->

        <hr>

        <!-- START Comments-->
        <section class="comments">
            <div class="comments__wrap">
                <h2 class="comments__header">Комментарии: </h2>
                <ul class="comments__list">
                    <li class="comments__item">
                        <div class="user_name">Юрий Платов :</div>
                        <div class="wrap_comment_content">
                            <div class="comment_title">Заголовок комментария</div>
                            <hr>
                            <p class="comment_text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Debitis,
                                pohibilic hic.</p></div>
                        <span class="comment_date">22.07.12</span>
                    </li>
                    <li class="comments__item">
                        <div class="user_name">Юрий Платов :</div>
                        <div class="wrap_comment_content">
                            <div class="comment_title">Заголовок комментария</div>
                            <hr>
                            <p class="comment_text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Debitis,
                                pohibilic hic. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Debitis,
                                pohibilic hic.</p></div>
                        <span class="comment_date">22.07.12</span>
                    </li>
                    <li class="comments__item">
                        <div class="user_name">Юрий Платов :</div>
                        <div class="wrap_comment_content">
                            <div class="comment_title">Заголовок комментария</div>
                            <hr>
                            <p class="comment_text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Debitis,
                                pohibilic hic.</p></div>
                        <span class="comment_date">22.07.12</span>
                    </li>
                </ul>
            </div>
        </section>
        <!-- END Comments-->
    </div>

<?php
require_once 'footer.php';
?>