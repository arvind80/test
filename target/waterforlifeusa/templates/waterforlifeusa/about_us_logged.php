<h2 class="blue-title-normal"><? print $page['content_title'] ?></h2>
<div class="richtext">
	<? print $subdomain_user['user_information']; ?>
</div>
<p class="richtext">
	<? $aboutUsText = $this->content_model->contentGetByIdAndCache(182); ?>
	<? print $aboutUsText['content_body']; ?>
</p>