
<?php
/**
 * Elgg sidebar contents
 *
 * @uses $vars['sidebar'] Optional content that is displayed at the bottom of sidebar
 */
?>
	

<?php
echo elgg_view_menu('extras', array(
	'sort_by' => 'priority',
	'class' => 'elgg-menu-hz',
));

if (elgg_is_logged_in()) {
if ((elgg_get_context() == 'activity')) {




		
	$groups=elgg_get_site_url() . "groups/all/";
	$groupstitle=elgg_echo('groups:all');
	
	$members=elgg_get_site_url() . "members/";
	$memberstitle=elgg_echo('members:all');
	
	$bookmarks=elgg_get_site_url() . "bookmarks/all/";
	$bookmarkstitle=elgg_echo('bookmarks:everyone');
	
	$wire=elgg_get_site_url() . "thewire/all/";
	$wiretitle=elgg_echo('thewire:everyone');
	
	echo '</br><ul class="elgg-menu elgg-menu-page elgg-menu-page-default">
	<li class="elgg-menu-item-bookmarklet">
	
	<a title="';
	echo $memberstitle; echo '" href="';
	echo $members; echo'">';echo elgg_echo('All Members');echo '</a>
	
	<a title="';
	echo $bookmarkstitle; echo '" href="';
	echo $bookmarks; echo'">';echo elgg_echo('bookmarks:everyone');echo '</a>
	
	<a title="';
	echo $groupsstitle; echo '" href="';
	echo $groups; echo'">';echo elgg_echo('groups:all');echo '</a>
	
	<a title="';
	echo $wiretitle; echo '" href="';
	echo $wire; echo'">';echo elgg_echo('thewire:everyone');
	
	echo '</a></li></ul></br></br>';
/**
 * Friends online module
 *
 */

$title = elgg_echo('your friends online');   

$options = array(
	'type' => 'user',
	"limit" => FALSE,
	'relationship' => 'friend',
	'relationship_guid' => elgg_get_logged_in_user_guid(),
	'inverse_relationship' => FALSE,
	'full_view' => FALSE,
	'pagination' => FALSE,
	'list_type' => 'gallery',
	'gallery_class' => 'elgg-gallery-users',
);		
$friends_online = elgg_get_entities_from_relationship($options);

$result = '';
foreach ($friends_online as $online) {
	if ($online->last_action > time() - 300) {
		$result .= elgg_view_entity_icon($online, 'tiny');
	} 
}
if ($result) {
	echo elgg_view_module('featured', $title, $result);
} else {
	$result = elgg_echo('no friend online');
	echo elgg_view_module('featured', $title, $result);
}
elgg_push_context('widgets');

$title = elgg_view('output/url', array(
	'href' => "/members",
	'text' => elgg_echo('latest members'),
	'is_trusted' => true,
));

$options = array(
	'type' => 'user', 
	'full_view' => false,
	'pagination' => FALSE,
	'limit' => $num,
	'list_type' => 'gallery'
);
$content = elgg_list_entities($options);

elgg_pop_context();

echo elgg_view_module('featured', $title, $content);
	
}
}

echo elgg_view('page/elements/owner_block', $vars);

echo elgg_view_menu('page', array('sort_by' => 'name'));

// optional 'sidebar' parameter
if (isset($vars['sidebar'])) {
	echo $vars['sidebar'];
}

// @todo deprecated so remove in Elgg 2.0
// optional second parameter of elgg_view_layout
if (isset($vars['area2'])) {
	echo $vars['area2'];
}

// @todo deprecated so remove in Elgg 2.0
// optional third parameter of elgg_view_layout
if (isset($vars['area3'])) {
	echo $vars['area3'];
}
