<?php
use yii\helpers\Url;
?>

<div id="mySidenav" class="sidenav border-end h-100">
    <ul class="pl-0">
        <li>
        <a id="about" href="<?= Url::toRoute(['pages/view', 'id' => 'about']) ?>"><i class="fa fa-fw fa-home"></i> Overview</a>
        </li>
        <li class="divider"></li>
        <li>
            <button class="dropdown-btn">Profile<i class="fa fa-caret-down"></i></button>
            <div class="dropdown-container">
                <a id="about" href="<?= Url::toRoute(['about/index']) ?>">About</a>
                <a id="research" href="#>">Research</a>
                <a id="lecture" href="<?= Url::toRoute(['lecture/index']) ?>">Lectures</a>
            </div>
        </li>
        <li class="divider"></li>
        <li>
            <button class="dropdown-btn">Publications<i class="fa fa-caret-down"></i></button>
            <div class="dropdown-container">
                <a id="mission" href="<?= Url::toRoute(['publications/index']) ?>">Research Paper</a>
                <a id="book" href="<?= Url::toRoute(['book/index']) ?>">Books</a>
            </div>
        </li>
        <li>
            <button class="dropdown-btn">Achievements<i class="fa fa-caret-down"></i></button>
            <div class="dropdown-container">
                <a id="honor-award" href="#">Honors and Awards</a>
                <a id="government-industry-project" href="#">Government Industry Project</a>
                <a id="phd-project" href="#">Phd Project</a>
            </div>
        </li>
        <li>
            <button class="dropdown-btn">Activities<i class="fa fa-caret-down"></i></button>
            <div class="dropdown-container">
                <a id="activity" href="#">Professional Activities</a>
                <a id="conference" href="<?= Url::toRoute(['conference-and-seminar/index']) ?>">Conference Seminar</a>
                <a id="outreach-activity" href="<?= Url::toRoute(['outreach-activity/index']) ?>">Outreach Activity</a>
            </div>
        </li>
        <li class="divider"></li>
        <!-- <a id="mission" href="<?= Url::toRoute(['outreach-programme/index']) ?>">Outreach Programme</a>
        </li>
        <li class="divider"></li> -->
        <li>
            <button class="dropdown-btn">More<i class="fa fa-caret-down"></i></button>
            <div class="dropdown-container">
                <a id="gallery" href="<?= Url::toRoute(['gallery/index']) ?>">Gallery</a>
                <a id="my-family" href="<?= Url::toRoute(['my-family/index']) ?>">My Family</a>
            </div>
        </li>
        <li class="divider"></li>
        <li>
        <a id="mission" href="<?= Url::toRoute(['recent-highlight/index']) ?>">Recent Highlights</a>
        </li>
        <li class="divider"></li>
        <li>
        <a id="mission" href="<?= Url::toRoute(['media/index']) ?>">Media</a>
        </li>
        <li class="divider"></li>
    </ul>
</div>