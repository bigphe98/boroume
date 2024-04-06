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
                    <div class="input">
                        <input type="text" placeholder="Search People" id="mysearch" oninput="search()" autocomplete="off">
                    </div>
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

            foreach($unregistered_people as $unregistered):


                ?>
                <div class="peopleCard" id="peopleCards_<?=$unregistered->peopleId?>">
                    <div class="nonexpanded" id="nonexpand_<?=$unregistered->peopleId?>" style="display: block;">
                        <div class="row justify-content-center">
                            <div class="col-md-5">
                                <address>
                                    <div class="row">
                                        <strong class="peopleName" style="font-family: 'Canada', sans-serif"><?=$unregistered->peopleFirstName?> <?=$unregistered->peopleLastName?></strong>
                                    </div>
                                    <div class="row">
                                        <abbr style="font-family: 'Canada', sans-serif" title="email"><?=$unregistered->peopleEmailAddress?></abbr>
                                    </div>
                                    <div class="row">
                                        <abbr style="font-family: 'Canada', sans-serif" title="telephone"><?=$unregistered->peopleTelephoneNumber?></abbr>
                                    </div>
                                    <div class="row">
                                        <abbr style="font-family: 'Canada', sans-serif" title="location"><?=$unregistered->peopleLocation?></abbr>
                                    </div>
                                </address>
                            </div>
                            <div class="col-md-5">
                                <div class="row">
                                        <strong class="impact-text" style="font-family: 'Canada', sans-serif">Impact</strong>
                                </div>
                                <div class="row">
                                        <abbr class="action-text" style="font-family: 'Canada', sans-serif">Actions: </abbr>
                                </div>
                                <div class="row">
                                        <abbr class="CO-text" style="font-family: 'Canada', sans-serif">CO2:</abbr>
                                </div>
                                <div class="row">
                                        <abbr class="kgs-text" style="font-family: 'Canada', sans-serif">KGs:</abbr>
                                </div>
                            </div>
                            <div class="col-md-1 align-self-center">

                                <div class="row">
                                    <div class="col-md-12">
                                        <button class="roundbutton" id="deleteStudentButton1_<?=$unregistered->peopleId?>" title="approve volunteer" onclick="approvePerson(<?=$unregistered->peopleId?>, '<?=$unregistered->peopleFirstName?>', '<?=$unregistered->peopleEmailAddress?>')">
                                            <span class="material-symbols-outlined">
                                            person_check
                                            </span>
                                        </button>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-1 align-self-center">
                                <div class="row">
                                    <div class="col-md-12">
                                        <button class="roundbutton" id="removeStudentButton1_<?=$unregistered->peopleId?>" title="cancel volunteer" onclick="cancelPerson(<?=$unregistered->peopleId?>)">
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
