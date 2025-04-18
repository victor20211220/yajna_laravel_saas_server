<?php

namespace App\Http\Controllers;

use App\Models\EmailTemplate;
use App\Models\Utility;
use App\Models\EmailTemplateLang;
use Illuminate\Http\Request;
use App\Models\Languages;


class EmailTemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $EmailTemplates =EmailTemplate::all();
        return view('email_templates.index', compact('EmailTemplates'));
    }

    public function manageEmailLang($id, $lang = 'en')
    {
        if (\Auth::user()->can('manage email templates'))
        {
            $languages         = Utility::languages();
            $emailTemplate     = EmailTemplate::where('id', '=', $id)->first();
            $EmailTemplates =EmailTemplate::all();
            $currEmailTempLang = EmailTemplateLang::where('parent_id', '=', $id)->where('lang', $lang)->first();

            if(!isset($currEmailTempLang) || empty($currEmailTempLang))
            {
                $currEmailTempLang       = EmailTemplateLang::where('parent_id', '=', $id)->where('lang', 'en')->first();
                $currEmailTempLang->lang = $lang;
            }
            $languageData=Languages::languageData($currEmailTempLang->lang);

            if($languageData==null)
                {
                    return redirect()->back();
                }
            return view('email_templates.show', compact('emailTemplate','EmailTemplates', 'languages', 'currEmailTempLang','languageData'));

        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }

    }

    public function updateEmailSettings(Request $request,$id){

        $validator = \Validator::make(
            $request->all(), [
                               'subject' => 'required',
                               'content' => 'required',
                           ]
        );
        if($validator->fails())
        {
            $messages = $validator->getMessageBag();
            return redirect()->back()->with('error', $messages->first());
        }

        $emailLangTemplate = EmailTemplateLang::where('parent_id', '=', $id)->where('lang', '=', $request->lang)->first();
        // if record not found then create new record else update it.
        if(empty($emailLangTemplate))
        {
            $emailLangTemplate            = new EmailTemplateLang();
            $emailLangTemplate->parent_id = $id;
            $emailLangTemplate->lang      = $request['lang'];
            $emailLangTemplate->subject   = $request['subject'];
            $emailLangTemplate->content   = $request['content'];
            $emailLangTemplate->save();
        }
        else
        {
            $emailLangTemplate->subject = $request['subject'];
            $emailLangTemplate->content = $request['content'];
            $emailLangTemplate->save();
        }
        return redirect()->route(
            'manage.email.language', [
                                        $id,
                                        $request->lang,
                                    ]
        )->with('success', __('The email template details are updated successfully'));

    }


    public function update(Request $request, $id)
    {
        $emailTemplate = EmailTemplate::find($id);
        $emailTemplate->from = $request->from;
        $emailTemplate->save();
        return redirect()->back()->with('success', __('The email template details are updated successfully'));
    }



}
