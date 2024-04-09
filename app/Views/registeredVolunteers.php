<?php
/**
 * @var $unregistered_people string
 * @var $registered_people string
 */
?>
<div class="container" id="pagewithpopup">
    <div class="backgroundpage" id="backgroundpage">
        <div class="container" id="searchcontainer">
            <div class="row justify-content-end">
                <div>
                    <!--<span class="material-symbols-outlined" id="searchVolunteers" onclick="openSearch()">
                    search
                    </span>-->
                    <div class="input">
                        <input type="text" placeholder="Search People" id="mysearch" oninput="search()" autocomplete="off">
                    </div>
                    <!--<span class="material-symbols-outlined" id="closeSearchVolunteers">
                    close
                    </span>-->
                </div>
            </div>
        </div>
        <div class="container-fluid" id="emptyState" style="display: none;">
            <div class="row justify-content-center">
                <img class="emptystate" src="<?=base_url()?>/public/icons/Boroume-sti-Laiki_3-960x600.jpg" alt="empty state overview">
            </div>
        </div>

        <div class="container-fluid" id="scrollable1">
            <?php

            foreach($registered_people as $registered):


                ?>
                <div class="peopleCard" id="peopleCards_<?=$registered->peopleId?>">
                    <div class="nonexpanded" id="nonexpand_<?=$registered->peopleId?>" style="display: block;">
                        <div class="row justify-content-center">
                            <div class="col-md-5">
                                <address>
                                    <div class="row">
                                        <strong class="peopleName" style="font-family: 'Canada', sans-serif"><?=$registered->peopleFirstName?> <?=$registered->peopleLastName?></strong>
                                    </div>
                                    <div class="row">
                                        <abbr style="font-family: 'Canada', sans-serif" title="email"><?=$registered->peopleEmailAddress?></abbr>
                                    </div>
                                    <div class="row">
                                        <abbr style="font-family: 'Canada', sans-serif" title="telephone"><?=$registered->peopleTelephoneNumber?></abbr>
                                    </div>
                                    <div class="row">
                                        <abbr style="font-family: 'Canada', sans-serif" title="location"><?=$registered->peopleLocation?></abbr>
                                    </div>
                                </address>
                            </div>
                            <div class="col-md-5">
                                <div class="row">
                                    <strong class="impact-text" style="font-family: 'Canada', sans-serif"><?= lang('Text.ImpactText')?></strong>
                                </div>
                                <div class="row">
                                    <abbr class="action-text" style="font-family: 'Canada', sans-serif"><?= lang('Text.ActionsText')?></abbr>
                                </div>
                                <div class="row">
                                    <abbr class="CO-text" style="font-family: 'Canada', sans-serif"><?=lang('Text.CO2Text')?></abbr>
                                </div>
                                <div class="row">
                                    <abbr class="kgs-text" style="font-family: 'Canada', sans-serif"><?=lang('Text.KgsText')?></abbr>
                                </div>
                            </div>
                            <div class="col-md-1 align-self-center">

                                <div class="row">
                                    <div class="col-md-12">

                                    </div>
                                </div>

                            </div>
                            <div class="col-md-1 align-self-center">
                                <div class="row">
                                    <div class="col-md-12">
                                        <button class="roundbutton" id="removeVolunteerButton1_<?=$registered->peopleId?>" title="cancel volunteer" onclick="cancelPerson(<?=$registered->peopleId?>)">
                                                <span class="material-symbols-outlined">
                                            person_cancel
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php

            endforeach;

            ?>
        </div>
    </div>
</div>
