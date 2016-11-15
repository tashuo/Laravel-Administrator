@if (is_array($item))
	@if ($key == 'live' || Auth::user()->hasRole(['admin', 'operater']))
	<li class="menu">
		<span>{{$item['title']}}</span>
		<ul>
			@foreach ($item['menu'] as $k => $subitem)
				<?php echo view("administrator::partials.menu_item", array(
					'item' => $subitem,
					'key' => $k,
					'settingsPrefix' => $settingsPrefix,
					'pagePrefix' => $pagePrefix
				))?>
			@endforeach
		</ul>
	</li>
	@endif
@else
	@if (Auth::user()->hasRole(['admin', 'operater']) || $key == 'live')
		<li class="item<?=(strpos($_SERVER['REQUEST_URI'], $key) > 0 || ($_SERVER['REQUEST_URI'] == '/admin/settings/site' && $key == 'settings.site')) ? ' focus' : ''?>">
			@if (strpos($key, $settingsPrefix) === 0)
				<a href="{{route('admin_settings', array(substr($key, strlen($settingsPrefix))))}}">{{$item}}</a>
			@elseif (strpos($key, $pagePrefix) === 0)
				<a href="{{route('admin_page', array(substr($key, strlen($pagePrefix))))}}">{{$item}}</a>
			@else
				<a href="{{route('admin_index', array($key))}}">{{$item}}</a>
			@endif
		</li>
	@endif
@endif
