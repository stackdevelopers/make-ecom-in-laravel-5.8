<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CmsPage;
use App\Category;
use Illuminate\Support\Facades\Mail;
use Validator;
use App\Enquiry;

class CmsController extends Controller
{
    public function addCmsPage(Request $request){
    	if($request->isMethod('post')){
    		$data = $request->all();
    		/*echo "<pre>"; print_r($data); die;*/
            if(empty($data['meta_title'])){
                $data['meta_title'] = "";    
            }
            if(empty($data['meta_description'])){
                $data['meta_description'] = "";    
            }
            if(empty($data['meta_keywords'])){
                $data['meta_keywords'] = "";    
            }
    		$cmspage = new CmsPage;
    		$cmspage->title = $data['title'];
    		$cmspage->url = $data['url'];
            $cmspage->description = $data['description'];
            $cmspage->meta_title = $data['meta_title'];
            $cmspage->meta_description = $data['meta_description'];
    		$cmspage->meta_keywords = $data['meta_keywords'];
    		if(empty($data['status'])){
    			$status = 0;
    		}else{
    			$status = 1;
    		}
    		$cmspage->status = $status;
    		$cmspage->save();
    		return redirect()->back()->with('flash_message_success','CMS Page has been added successfully');
    	}
    	return view('admin.pages.add_cms_page');
    }

    public function editCmsPage(Request $request,$id){
        if($request->isMethod('post')){
            $data = $request->all();
            if(empty($data['status'])){
                $status = 0;
            }else{
                $status = 1;
            }
            if(empty($data['meta_title'])){
                $data['meta_title'] = "";    
            }
            if(empty($data['meta_description'])){
                $data['meta_description'] = "";    
            }
            if(empty($data['meta_keywords'])){
                $data['meta_keywords'] = "";    
            }
            CmsPage::where('id',$id)->update(['title'=>$data['title'],'url'=>$data['url'],'description'=>$data['description'],'meta_title'=>$data['meta_title'],'meta_description'=>$data['meta_description'],'meta_keywords'=>$data['meta_keywords'],'status'=>$status]);
            return redirect()->back()->with('flash_message_success','CMS Page has been updated successfully!');
        }
        $cmsPage = CmsPage::where('id',$id)->first();
        return view('admin.pages.edit_cms_page')->with(compact('cmsPage'));
    }

    public function viewCmsPages(){
        $cmsPages = CmsPage::get();
        return view('admin.pages.view_cms_pages')->with(compact('cmsPages'));
    }

    public function deleteCmsPage($id){
        CmsPage::where('id',$id)->delete();
        return redirect('/admin/view-cms-pages')->with('flash_message_success','CMS Page has been deleted successfully!');
    }

    public function cmsPage($url){

        // Redirect to 404 if CMS Page is disabled or does not exists
        $cmsPageCount = CmsPage::where(['url'=>$url,'status'=>1])->count();
        if($cmsPageCount>0){
            // Get CMS Page Details
            $cmsPageDetails = CmsPage::where('url',$url)->first();
            $meta_title = $cmsPageDetails->meta_title;
            $meta_description = $cmsPageDetails->meta_description;
            $meta_keywords = $cmsPageDetails->meta_keywords;
        }else{
            abort(404);    
        }

        // Get All Categories and Sub Categories
        $categories_menu = "";
        $categories = Category::with('categories')->where(['parent_id' => 0])->get();
        $categories = json_decode(json_encode($categories));
        /*echo "<pre>"; print_r($categories); die;*/
        foreach($categories as $cat){
            $categories_menu .= "
            <div class='panel-heading'>
                <h4 class='panel-title'>
                    <a data-toggle='collapse' data-parent='#accordian' href='#".$cat->id."'>
                        <span class='badge pull-right'><i class='fa fa-plus'></i></span>
                        ".$cat->name."
                    </a>
                </h4>
            </div>
            <div id='".$cat->id."' class='panel-collapse collapse'>
                <div class='panel-body'>
                    <ul>";
                    $sub_categories = Category::where(['parent_id' => $cat->id])->get();
                    foreach($sub_categories as $sub_cat){
                        $categories_menu .= "<li><a href='#'>".$sub_cat->name." </a></li>";
                    }
                        $categories_menu .= "</ul>
                </div>
            </div>
            ";      
        }

        return view('pages.cms_page')->with(compact('cmsPageDetails','categories_menu','categories','meta_title','meta_keywords','meta_description'));
    }

    public function contact(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            /*echo "<pre>"; print_r($data); die;*/

            $validator = Validator::make($request->all(), [
                'name' => 'required|regex:/^[\pL\s\-]+$/u|max:255',
                'email' => 'required|email',
                'subject' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            // Send Contact Email
            $email = "admin1000@yopmail.com";
            $messageData = [
                'name'=>$data['name'],
                'email'=>$data['email'],
                'subject'=>$data['subject'],
                'comment'=>$data['message']
            ];
            Mail::send('emails.enquiry',$messageData,function($message)use($email){
                $message->to($email)->subject('Enquiry from E-com Website');
            });

            return redirect()->back()->with('flash_message_success','Thanks for your enquiry. We will get back to you soon.');
        }

        // Get All Categories and Sub Categories
        $categories_menu = "";
        $categories = Category::with('categories')->where(['parent_id' => 0])->get();
        $categories = json_decode(json_encode($categories));
        /*echo "<pre>"; print_r($categories); die;*/
        foreach($categories as $cat){
            $categories_menu .= "
            <div class='panel-heading'>
                <h4 class='panel-title'>
                    <a data-toggle='collapse' data-parent='#accordian' href='#".$cat->id."'>
                        <span class='badge pull-right'><i class='fa fa-plus'></i></span>
                        ".$cat->name."
                    </a>
                </h4>
            </div>
            <div id='".$cat->id."' class='panel-collapse collapse'>
                <div class='panel-body'>
                    <ul>";
                    $sub_categories = Category::where(['parent_id' => $cat->id])->get();
                    foreach($sub_categories as $sub_cat){
                        $categories_menu .= "<li><a href='#'>".$sub_cat->name." </a></li>";
                    }
                        $categories_menu .= "</ul>
                </div>
            </div>
            ";      
        }

        $meta_title = "Contact Us - E-shop Sample Website";
        $meta_description = "Contact us for any queries related to our products.";
        $meta_keywords = "contact us, queries";
        return view('pages.contact')->with(compact('categories_menu','categories','meta_title','meta_description','meta_keywords'));
    }

    public function addPost(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            /*echo "<pre>"; print_r($data); die;*/
            $enquiry = new Enquiry;
            $enquiry->name = $data['name'];
            $enquiry->email = $data['email'];
            $enquiry->subject = $data['subject'];
            $enquiry->message = $data['message'];
            $enquiry->save();
            echo "Thanks for contacting us. We will get back to you soon."; die;
        }

        // Get All Categories and Sub Categories
        $categories_menu = "";
        $categories = Category::with('categories')->where(['parent_id' => 0])->get();
        $categories = json_decode(json_encode($categories));
        /*echo "<pre>"; print_r($categories); die;*/
        foreach($categories as $cat){
            $categories_menu .= "
            <div class='panel-heading'>
                <h4 class='panel-title'>
                    <a data-toggle='collapse' data-parent='#accordian' href='#".$cat->id."'>
                        <span class='badge pull-right'><i class='fa fa-plus'></i></span>
                        ".$cat->name."
                    </a>
                </h4>
            </div>
            <div id='".$cat->id."' class='panel-collapse collapse'>
                <div class='panel-body'>
                    <ul>";
                    $sub_categories = Category::where(['parent_id' => $cat->id])->get();
                    foreach($sub_categories as $sub_cat){
                        $categories_menu .= "<li><a href='#'>".$sub_cat->name." </a></li>";
                    }
                        $categories_menu .= "</ul>
                </div>
            </div>
            ";      
        }

        return view('pages.post')->with(compact('categories_menu','categories'));
    }

    public function getEnquiries(){
        $enquiries = Enquiry::orderBy('id','Desc')->get();
        $enquiries = json_encode($enquiries);
        return $enquiries;
    }

    public function viewEnquiries(){
        return view('admin.enquiries.view_enquiries');
    }
}
