<?php
_require('app/controllers/Controller.php');
_model('Service');
/**
 * admin service controller
 */
class AdminServiceController extends Controller
{
	private $service;

	public function __construct($method)
	{
		if (!auth() || auth('role') === 'user') {
			header('location: /');
		}
	}

	public function services(Request $request)
	{
		$services = Service::paginate(10);
		return view('admin/services/services', compact('services'));
	}

	public function createService()
	{
		return view('admin/services/create_form');
	}

	public function saveService(Request $request, $update = false)
	{
		$v = $this->validate($request, [
			'title' => 'required',
			'description' => 'required'
		]);
		if($v->hasInvalidField()) {
			http_response_code(422);
			return $v->bag();
		}

		$data = $request->all();

		if ($request->hasFile('service_file')) {
			$file_n = $request->file('service_file')->original_name();
			$p = $request->move('assets/img/services', time() . $file_n);
			$data['file_path'] = $p ?: '';
		}

		if ($request->hasFile('service_img')) {
			$file_n = $request->file('service_img')->original_name();
			$p = $request->move('assets/img/services', time() . $file_n);
			$data['img_path'] = $p ?: '';
		}

		$data['slug'] = slug($request->input('title'));

		$service = !$update ? Service::create($data) : Service::where(['id' => $this->service->id])->update($data);

		if (!$service) {
			http_response_code(500);
		} else {
			http_response_code(201);
		}
	}

	public function editServiceForm($id)
	{
		$service = Service::where(['id' => $id])->first();
		return view('admin/services/edit_form', compact('service'));
	}

	public function updateService(Request $request, $id)
	{
		$this->service = Service::where(['id' => $id])->first();
		return $this->saveService($request, true);
	}

	public function deleteService($service)
	{
		$count = Service::where(['id' => $service])->count();
		if($count) {
			Service::where(['id' => $service])->delete();
		} else {
			http_response_code(404);
		}
	}
}