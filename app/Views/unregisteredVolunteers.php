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
                                    <?=lang('Text.residencyText')?><abbr title="residency" style="font-family: 'Canada', sans-serif"><?=$unregistered->residentOf?></abbr>
                                </div>
                                <div class="row">
                                    <?=lang('Text.afmText')?><abbr title="AFM/TIN" style="font-family: 'Canada', sans-serif"><?=$unregistered->AFM_TIN?></abbr>
                                </div>
                                <div class="row">
                                    <?=lang('Text.doyText')?><abbr title="DOY/TO" style="font-family: 'Canada', sans-serif"><?=$unregistered->DOY_TO?></abbr>
                                </div>
                                <div class="row">
                                    <?=lang('Text.hospitalText')?><abbr title="medical institute" style="font-family: 'Canada', sans-serif"><?=$unregistered->medicalInstitute?></abbr>
                                </div>
                            </div>
                            <div class="col-md-1 align-self-center">

                                <div class="row">
                                    <div class="col-md-12">
                                        <button class="roundbutton" id="addVolunteerButton1_<?=$unregistered->peopleId?>" title="approve volunteer" onclick="approvePerson(<?=$unregistered->peopleId?>, '<?=$unregistered->peopleFirstName?>', '<?=$unregistered->peopleEmailAddress?>')">
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
                                        <button class="roundbutton" id="removeVolunteerButton1_<?=$unregistered->peopleId?>" title="manage volunteer" onclick="managePerson(<?=$unregistered->peopleId?>)">
                                                <span class="material-symbols-outlined">
                                            manage_accounts
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
