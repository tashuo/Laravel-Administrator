<header>
	<h1>
		<a href="{{route('admin_dashboard')}}">{{config('administrator.title')}}</a>
	</h1>

	<a href="#" id="menu_button"><div></div></a>
	<a href="#" id="filter_button" class="{{$configType === 'model' ? '' : 'hidden'}}"><div></div></a>

	<div id="mobile_menu_wrapper">
		<ul id="mobile_menu">
			@foreach ($menu as $key => $item)
				@include('administrator::partials.menu_item')
			@endforeach
		</ul>
	</div>

	<ul id="menu">
		@foreach ($menu as $key => $item)
			@include('administrator::partials.menu_item')
		@endforeach
	</ul>
	<!-- <div id="right_nav">
		@if (count(config('administrator.locales')) > 0)
			<ul id="lang_menu">
				<li class="menu">
				<span>{{config('app.locale')}}</span>
					@if (count(config('administrator.locales')) > 1)
						<ul>
							@foreach (config('administrator.locales') as $lang)
								@if (config('app.locale') != $lang)
									<li>
										<a href="{{route('admin_switch_locale', array($lang))}}">{{$lang}}</a>
									</li>
								@endif
							@endforeach
						</ul>
					@endif
				</li>
			</ul>
		@endif
		<a href="{{url(config('administrator.back_to_site_path', '/'))}}" id="back_to_site">{{trans('administrator::administrator.backtosite')}}</a>
		@if(config('administrator.logout_path'))
			<a href="{{url(config('administrator.logout_path'))}}" id="logout">{{trans('administrator::administrator.logout')}}</a>
		@endif
	</div> -->

	<div id="right_nav">
		<ul id="lang_menu">
			<li class="menu">
				<span>{{ Auth::user()->name }}</span>
				@if(config('administrator.logout_path'))
					<ul>
						<li>
							<a href="{{url(config('administrator.logout_path'))}}" id="logout" onclick="event.preventDefault();document.getElementById('logout-form').submit();">{{trans('administrator::administrator.logout')}}</a>
							<form id="logout-form" action="{{ url(config('administrator.logout_path')) }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
						</li>
					</ul>
				@endif
			</li>

		</ul>
		@if (Auth::user()->hasRole(['admin', 'operater']))
			<a href="{{url('/users/create')}}" id="back_to_site">{{trans('administrator::administrator.create_new_administrator')}}</a>
		@endif
	</div>
</header>