<?php

class PhotoController extends BaseController {

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author 
	 **/
	public function create()
	{
		return View::make('photo.create');
	}

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author 
	 **/
	public function store()
	{
		Image::canvas(140,140,'#f7f7f7')->save(public_path().'/uploads/back.png');

		$rules = array(
				'photo' => 'required|image',
				);

    	$validator = Validator::make(Input::all(), $rules);

	    if ($validator->fails())
	    {
			return Redirect::back()->withInput()->withErrors($validator->errors());
	    }

	    $optimize = Input::has('optimize') ? true : false;

		$file = Input::file('photo');

		$filename = $file->getClientOriginalName();

		// $extension = $file->getClientOriginalExtension(); //Get the extension

		// $filename = time().'.'.$extension;

		$mime = $file->getMimeType(); //Get the extension

		$file->move(public_path().'/uploads', $filename);

		$dest = public_path().'/uploads/'.$filename;

		$image = Image::make($dest);

		$width = Input::has('width') ? Input::get('width') : $image->width();

		$height = Input::has('height') ? Input::get('height') : $image->height();


		if(!$optimize)
		{

			$image = Image::make($dest)
					->resize($width,$height,function ($constraint) {
					    $constraint->aspectRatio();
					});

			$image->save($dest);

		}

		Image::make(public_path().'/uploads/back.png')
			->insert($dest,'center')->save($dest);

		if($mime == 'image/jpeg')
		{
			$cmd = 'jpegoptim --strip-all '.$dest;

			$result = exec($cmd);
		}
		elseif ($mime == 'image/png') 
		{
			$cmd = 'optipng -o7 '.$dest;

			$result = exec($cmd);
		}
		else
		{
			$result = 'done';
		}

		$headers = array(
              'Content-Type: '.$mime,
        );

        return Response::download($dest, $filename, $headers);
	}

}
