<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\LanguageDataTable;
use App\Http\Requests;
use App\Http\Requests\LanguageCreateRequest;
use App\Http\Requests\LanguageUpdateRequest;
use App\Models\Language;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use File;

class LanguageController extends AppBaseController
{

    private $icon = 'pe-7s-comment';


    public function index(LanguageDataTable $languageDataTable)
    {
        $this->authorize('Language-view');
        $languages = Language::where('status', 1)->get();
        $icon = 'pe-7s-comment';
        return $languageDataTable->render('admin.languages.index', compact('icon', 'languages'));
    }


    public function create()
    {
        $this->authorize('Language-create');
        return view('admin.languages.create')->with('icon', $this->icon);
    }


    public function store(LanguageCreateRequest $request)
    {
        $this->authorize('Language-create');
        $status = $request->status ?? 0;
        Language::create(array_merge($request->all(), ['status' => $status]));
        File::copy('../resources/lang/en.json', '../resources/lang/' . $request->code . '.json');
        //$imageName = FileHelper::uploadImage($request);
        //Language::create(array_merge($request->all(), ['image' => $imageName]));
        notify()->success("Language Created Successful.", "Success");
        return redirect(route('admin.languages.index'));
    }


    public function show(Language $language)
    {
        $this->authorize('Language-view');
        return view('admin.languages.show', compact('language'))->with('icon', $this->icon);
    }


    public function edit(Language $language)
    {
        $this->authorize('Language-update');
        return view('admin.languages.edit', compact('language'))->with('icon', $this->icon);
    }


    public function update(Language $language, LanguageUpdateRequest $request)
    {
        $this->authorize('Language-update');
        $status = $request->status ?? 0;
        rename('../resources/lang/' . $language->code . '.json', '../resources/lang/' . $request->code . '.json');
        $language->fill(array_merge($request->all(), ['status' => $status]))->save();
        notify()->success("Language Updated Successful.", "Success");
        return redirect(route('admin.languages.index'));
    }


    public function destroy(Language $language)
    {
        $this->authorize('Language-delete');
        //FileHelper::deleteImage($language);
        File::delete('../resources/lang/' . $language->code . '.json');
        $language->delete();
    }

    public function setDefaultLanguage(Request $request)
    {
        $this->authorize('Language-set-default');
        updateEnv(['LOCALE' => $request->locale]);
        notify()->success("Default Language Set Successful.", "Success");
        return redirect(route('admin.languages.index'));
    }

    public function translatePage(Language $language)
    {
        $this->authorize('Language-translate');
        $translates = json_decode(file_get_contents('../resources/lang/' . $language->code . '.json'), true);

        return view('admin.languages.translate', compact('language', 'translates'))->with('icon', $this->icon);;
    }

    public function translate(Language $language, Request $request)
    {
        $this->authorize('Language-translate');

        $data = array();
        for ($i = 0; $i < sizeof($request['key']); $i++) {
            $data[$request->key[$i]] = $request->value[$i];
        }
        file_put_contents('../resources/lang/' . $language->code . '.json', json_encode($data));
        notify()->success("Language Set Successful.", "Success");
        return back();
    }
}
