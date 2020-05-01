<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/' , 'FrontendController@index');

//home controller routes
Route::get('/home', 'HomeController@index')->name('home');

//user controller routes
Route::get('/profile', 'UserController@profile')->name('profile');
Route::post('/password/change', 'UserController@passwordchange')->name('passwordchange');

//slider controller routes
Route::get('/slider', 'SliderController@slider')->name('slider');
Route::post('/slider/insert', 'SliderController@sliderinsert')->name('sliderinsert');
Route::get('/slider/edit/{slider_id}', 'SliderController@slideredit');
Route::post('/slider/edit/{id}', 'SliderController@sliderupdate');
Route::get('/slider/delete/{slider_id}', 'SliderController@sliderdelete');

//about controller routes
Route::get('/about', 'AboutController@about')->name('about');
Route::post('/about/insert', 'AboutController@aboutinsert')->name('aboutinsert');
Route::get('/about/edit/{about_id}', 'AboutController@aboutedit');
Route::post('/about/edit/{id}', 'AboutController@aboutupdate');
Route::get('/about/delete/{about_id}', 'AboutController@aboutdelete');

//service controller routes
Route::get('/service', 'ServiceController@service')->name('service');
Route::post('/service/insert', 'ServiceController@serviceinsert')->name('serviceinsert');
Route::get('/service/edit/{service_id}', 'ServiceController@serviceedit');
Route::post('/service/edit/{id}', 'ServiceController@serviceupdate');
Route::get('/service/delete/{service_id}', 'ServiceController@servicedelete');

//client controller routes
Route::get('/client', 'ClientController@client')->name('client');
Route::post('/client/insert', 'ClientController@clientinsert')->name('clientinsert');
Route::get('/client/edit/{client_id}', 'ClientController@clientedit');
Route::post('/client/edit/{id}', 'ClientController@clientupdate');
Route::get('/client/delete/{client_id}', 'ClientController@clientdelete');

//portfolio controller routes
Route::get('/portfolio', 'PortfolioController@portfolio')->name('portfolio');
Route::post('/portfolio/insert', 'PortfolioController@portfolioinsert')->name('portfolioinsert');
Route::get('/portfolio/edit/{portfolio_id}', 'PortfolioController@portfolioedit');
Route::post('/portfolio/edit/{id}', 'PortfolioController@portfolioupdate');
Route::get('/portfolio/delete/{portfolio_id}', 'PortfolioController@portfoliodelete');

//testimonial controller routes
Route::get('/testimonial', 'TestimonialController@testimonial')->name('testimonial');
Route::post('/testimonial/insert', 'TestimonialController@testimonialinsert')->name('testimonialinsert');
Route::get('/testimonial/edit/{testimonial_id}', 'TestimonialController@testimonialedit');
Route::post('/testimonial/edit/{id}', 'TestimonialController@testimonialupdate');
Route::get('/testimonial/delete/{testimonial_id}', 'TestimonialController@testimonialdelete');

//Team controller routes
Route::get('/team', 'TeamController@team')->name('team');
Route::post('/team/insert', 'TeamController@teaminsert')->name('teaminsert');
Route::get('/team/edit/{team_id}', 'TeamController@teamedit');
Route::post('/team/edit/{id}', 'TeamController@teamupdate');
Route::get('/team/delete/{team_id}', 'TeamController@teamdelete');

//contact controller routes
Route::get('/contact', 'ContactController@contact')->name('contact');
Route::post('/contact/insert', 'ContactController@contactinsert')->name('contactinsert');
Route::get('/contact/edit/{contact_id}', 'ContactController@contactedit');
Route::post('/contact/edit/{id}', 'ContactController@contactupdate');
Route::get('/contact/delete/{contact_id}', 'ContactController@contactdelete');
