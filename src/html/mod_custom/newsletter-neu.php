<?php
defined('_JEXEC') or die;
use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use GHSVS\Plugin\System\Bs3Ghsvs\HTML\Helpers\Bs3ghsvsJHtml;

$wa = Factory::getDocument()->getWebAssetManager();

$js = <<<JS
document.addEventListener("DOMContentLoaded", function()
{
function loadjQuery(e,t)
{
	var n=document.createElement("script");
	n.setAttribute("src",e);
	n.onload=t;
	n.onreadystatechange=function()
	{
		if(this.readyState=="complete"||this.readyState=="loaded")t()
	};

	document.getElementsByTagName("head")[0].appendChild(n)
}
function main()
{
	var \$cr=jQuery.noConflict();
	var old_src;
	\$cr(document).ready(
		function()
		{
			\$cr(".cr_form").submit(
				function()
				{
					\$cr(this).find(".clever_form_error").removeClass("clever_form_error");
					\$cr(this).find(".clever_form_note").remove();
					\$cr(this).find(".musthave").find("input, textarea").each(
						function(){
							if(jQuery.trim(\$cr(this).val())==""||(\$cr(this).is(":checkbox"))||(\$cr(this).is(":radio")))
							{
								if(\$cr(this).is(":checkbox")||(\$cr(this).is(":radio")))
								{
									if(!\$cr(this).parents(".cr_ipe_item").find(":checked").is(":checked"))
									{
										\$cr(this).parents(".cr_ipe_item").addClass("clever_form_error")
									}
								}else
								{
									\$cr(this).addClass("clever_form_error")
								}
							}
						});
						if(\$cr(this).attr("action").search(document.domain)>0&&\$cr(".cr_form").attr("action").search("wcs")>0)
						{
							var cr_email=\$cr(this).find("input[name=email]");
							var unsub=false;
							if(\$cr("input['name=cr_subunsubscribe'][value='false']").length)
							{
								if(\$cr("input['name=cr_subunsubscribe'][value='false']").is(":checked"))
								{
									unsub=true
								}
							}
							if(cr_email.val()&&!unsub)
							{
								\$cr.ajax({
									type:"GET",
									url:\$cr(".cr_form").attr("action").replace("wcs","check_email")+window.btoa(
										\$cr(this).find("input[name=email]").val()
									),
									success:function(data)
									{
										if(data)
										{
											cr_email.addClass("clever_form_error").before("<div class='clever_form_note cr_font'>"+data+"</div>");
											return false
										}
									},
									async:false
								})
							}

							var cr_captcha=\$cr(this).find("input[name=captcha]");
							if(cr_captcha.val())
							{
								\$cr.ajax({
									type:"GET",
									url:\$cr(".cr_form").attr("action").replace("wcs","check_captcha")+\$cr(this).find('input[name=captcha]').val(),
									success:function(data)
									{
										if(data)
										{
											cr_captcha.addClass('clever_form_error').after("<div style='display:block' class='clever_form_note cr_font'>"+data+"</div>");
											return false
										}
									},
									async:false
								})
							}
						}

						if(\$cr(this).find(".clever_form_error").length)
						{
							return false
						}
						return true
				}
			);

			\$cr('input[class*="cr_number"]').change(
				function()
				{
					if(isNaN(\$cr(this).val()))
					{
						\$cr(this).val(1)
					}
					if(\$cr(this).attr("min"))
					{
						if((\$cr(this).val()*1)<(\$cr(this).attr("min")*1))
						{
							\$cr(this).val(\$cr(this).attr("min"))
						}
					}
					if(\$cr(this).attr("max"))
					{
						if((\$cr(this).val()*1)>(\$cr(this).attr("max")*1))
						{
							\$cr(this).val(\$cr(this).attr("max"))
						}
					}
				}
			);
			old_src=\$cr("div[rel='captcha'] img:not(.captcha2_reload)").attr("src");
			if(\$cr("div[rel='captcha'] img:not(.captcha2_reload)").length!=0)
			{
				captcha_reload()
			}
		}
	);
	function captcha_reload()
	{
		var timestamp=new Date().getTime();
		\$cr("div[rel='captcha'] img:not(.captcha2_reload)").attr("src","");
		\$cr("div[rel='captcha'] img:not(.captcha2_reload)").attr("src",old_src+"?t="+timestamp);
		return false
	}
}
if(typeof jQuery==="undefined")
{
	loadjQuery("//ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js",main)
}else
{main()}
});
JS;

$wa->useScript('jquery-migrate');
$wa->addInlineScript($js);
?>

<div class="customnewsletter">
	<form class="layout_form cr_form cr_font" action="https://seu2.cleverreach.com/f/102706-125375/wcs/" method="post" target="_blank">
		<div class="cr_body cr_page cr_font formbox">
			<div class="non_sortable">
			</div>
<?php
echo Bs3ghsvsJHtml::rendermodules('newsletter-text-above-captcha');
?>
			<div class="editable_content mt-3">
				<div id="3683116" rel="recaptcha" class="cr_ipe_item ui-sortable musthave">
					<?php $wa->useScript('koerperghsvs.google-recaptcha-api'); ?>
					<div id="recaptcha_v2_widget" class="g-recaptcha" data-theme="light" data-size="normal" data-sitekey="6Lfhcd0SAAAAAOBEHmAVEHJeRnrH8T7wPvvNzEPD">
					</div>


				</div>

				<div id="2566066" rel="email" class="cr_ipe_item ui-sortable musthave mt-3">
					<label for="text2566066" class="itemname visually-hidden">
						Trage bitte deine E-Mail ein, bevor du auf <?php echo Text::_('JLOGIN'); ?> klickst.
					</label>
					<input id="text2566066" name="email" value="" type="text" placeholder="Trage hier deine E-Mail ein" />
				</div>

<?php
echo Bs3ghsvsJHtml::rendermodules('newsletter-text-above-submit');
?>

				<div id="2566068" rel="button" class="cr_ipe_item ui-sortable submit_container mt-2">
					<button type="submit" class="btn btn-danger"><?php echo Text::_('JLOGIN'); ?></button>
				</div>
			</div><!--/.editable_content -->

			<div class="non_sortable">
			</div>
			<noscript><a href="https://seu2.cleverreach.com/f/102706-125375/">https://seu2.cleverreach.com/f/102706-125375</a></noscript>
		</div>

	</form>
</div><!--/.customnewsletter -->
