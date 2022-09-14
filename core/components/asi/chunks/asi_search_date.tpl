<div class="title">
    <div class="tipTitle">
        <div class="tipIcon" data-tooltip-content="#searchFilter[[!+tip_id]]Tooltip">
            <i class="far fa-question-circle"></i>
        </div>
        [[!+label]]
    </div>
</div>
<div class="inner">
    <p class="fieldLabel">[[!%asi.label_specify_exact_year? &topic=`label` &namespace=`asi`]]</p>
    <div class="inputWrapper wIcon">
        <i class="far fa-calendar-alt"></i>
        <input type="text" id="exactStart[[!+identifier]]" name="exactStart[[!+identifier]]" placeholder="YYYY">
    </div>
    <p class="fieldLabel">[[!%asi.label_or_time_period? &topic=`label` &namespace=`asi`]]</p>

    <div class="contentDropdown" data-section="date_set_century">
        [[!+set_century]]
    </div>

    <div class="contentDropdown disabled" data-section="date_set_decade">
        [[!+set_decade]]
    </div>

    <div class="contentDropdown disabled" data-section="date_set_year">
        [[!+set_year]]
    </div>

    [[-
    <div class="contentDropdown disabled">
        [[!+set_month]]
    </div>
    ]]
    
</div>