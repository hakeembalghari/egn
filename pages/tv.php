<?php
try{
$EmbedTv = $db->prepare("SELECT channel_name FROM embedtv WHERE main_channel=1");
		$EmbedTv->execute();	
}
catch(PDOException $ex)
{
	die("failed to run query:" . $ex->getMessage());	
	
}
$EmbedTv = $EmbedTv->fetchAll();
$EmbedTv = $EmbedTv[0];
$ChannelName = $EmbedTv['channel_name'];
$TvCode = '<object type="application/x-shockwave-flash" height="268" width="690" id="live_embed_player_flash" data="http://www.twitch.tv/widgets/live_embed_player.swf?channel='.$ChannelName.'" bgcolor="#000000"><param name="allowFullScreen" value="true" /><param name="allowScriptAccess" value="always" /><param name="allowNetworking" value="all" /><param name="movie" value="http://www.twitch.tv/widgets/live_embed_player.swf" /><param name="flashvars" value="hostname=www.twitch.tv&channel='.$ChannelName.'&auto_play=false&start_volume=25" /></object>';
$ChatCode='<iframe frameborder="0" scrolling="no" src="http://twitch.tv/'.$ChannelName.'/chat?popout=" height="268" width="300"></iframe>';

echo $TvCode;
echo $ChatCode;
?>
