<div style="background-color: #f4f5f6; border-bottom: .1rem solid #d1d1d1; text-align: center; margin-top: 52px; ">
	<div style="max-width: 80rem; margin: 0 auto;">
		<div class="row" style="width:100%">
			<div class="col-md-3 col-sm-3 col-xs-12 material-hover-box admin-goto-button" id="_ADMIN_STATS_TOTAL">
				<span>Total Reports</span>      <br>
				<span><?=( mBugReport::count()                                              )?></span>
			</div>
			
			<div class="col-md-3 col-sm-3 col-xs-12 material-hover-box admin-goto-button" id="_ADMIN_STATS_VISIBLE">
				<span>Visible Reports</span>    <br>
				<span><?=( mBugReport::countWhere([['visible', true], ['fixed', false]])    )?></span>
			</div>
			
			<div class="col-md-3 col-sm-3 col-xs-12 material-hover-box admin-goto-button" id="_ADMIN_STATS_UNCONFIRMED">
				<span>Unconfirmed Bugs</span>   <br>
				<span><?=( mBugReport::countWhere([['visible', false], ['fixed', false]])   )?></span>
			</div>
			
			<div class="col-md-3 col-sm-3 col-xs-12 material-hover-box admin-goto-button" id="_ADMIN_STATS_FIXED">
				<span>Fixed Bugs</span>         <br>
				<span><?=( mBugReport::countWhere(['fixed', true])                          )?></span>
			</div>
		</div>
	</div>
</div>