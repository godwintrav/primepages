<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Intervention\Image\ImageManager;
use Image;
use Illuminate\Support\Facades\Validator;
use App\Model\Post;
use App\Model\Comment;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use vendor\autoload;


class BlogController extends Controller
{
    public function add_blog(Request $request){
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'tags' => 'required|string|max:255',
            'image' => 'required',
            'img_desc' => 'string',
        ]);

        $extension = $request->file('image')->getClientOriginalExtension();

        if(!$this->validateImgExtension($extension)){

            $err_msg = "Unsupported Image Format";
            return $this->redirect_page('admin.add-blog',$err_msg);

        }

        $path = $request->file('image')->store('images');
        // $path = Image::make($request->file('image')->store('images'));

        //$manager = new ImageManager();
        //dd(asset('storage/'.$path));
        
        $image = Image::make('storage/'.$path)->resize(730, 500);
        $image->save('storage/'.$path);

        $post = Post::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'tags' => $data['tags'].",",
            'image' => $path,
            'img_desc' => $data['img_desc'],
        ]);

        if($post != null){
            return $this->redirect_page('admin.add-blog','Blog post added Successfully!');
        }else{
            return $this->redirect_page('admin.add-blog','Error Adding Blog');
        }

    }


    public function redirect_page($view, $msg = null){
        if($msg == null){
            return view($view);
        }
        return view($view, ['msg' => $msg]);
    }

    public function validateImgExtension($ext){
        $extensions = array("jpg","jpeg", "gif", "png", "apng", "svg", "bmp", "ico", "png", "ico");
        foreach($extensions as $extension){
            if(strcmp($extension,strtolower($ext)) == 0){
                return true;
            }
        }                  
        return false;
    }

    public function all_posts(){
        $i = 1;
        $posts = Post::orderBy('created_at', 'desc')->get();
        return view("admin.posts",['posts' => $posts, 'i' => $i]);
    }

    public function recent_posts(){
        $i = 1;
        $posts = Post::orderBy('created_at', 'desc')->get();
        $active = "Recent";
        $all_tags = $this->fetch_tags();
        $similiar_posts = Post::orderBy('created_at', 'asc')
                            ->limit(6)
                            ->get();
        return view("blog",['posts' => $posts, 'i' => $i, 'active' => $active, 'all_tags' => $all_tags, 'similiar_posts' => $similiar_posts]);
    }

    public function search_blog(Request $request){
        $data = $request->validate([
            'search' => 'required|string|max:255',
        ]);

        $posts = Post::orderBy("created_at", "desc")
            ->where("title","LIKE",'%'.$data['search'].'%')
            ->orWhere("tags","LIKE",'%'.$data['search'].'%')
            ->get();
        $active = "Search";
        $i = 1;
        $all_tags = $this->fetch_tags();
        $similiar_posts = Post::orderBy('created_at', 'desc')
                            ->limit(6)
                            ->get();
        return view("blog",['posts' => $posts, 'i' => $i, 'active' => $active, 'all_tags' => $all_tags, 'similiar_posts' => $similiar_posts]);    
    }

    public function search_tag($tag){
        $posts = Post::orderBy("created_at", "desc")
            ->where("tags","LIKE",'%'.$tag.'%')
            ->get();
        $active = "Search";
        $i = 1;
        $all_tags = $this->fetch_tags();
        $similiar_posts = Post::orderBy('created_at', 'desc')
                            ->limit(6)
                            ->get();
        return view("blog",['posts' => $posts, 'i' => $i, 'active' => $active, 'all_tags' => $all_tags, 'similiar_posts' => $similiar_posts]); 
    }

    public function older_posts(){
        $i = 1;
        $posts = Post::orderBy('created_at', 'asc')->get();
        $active = "Older";
        $all_tags = $this->fetch_tags();
        $similiar_posts = Post::orderBy('created_at', 'desc')
                            ->limit(6)
                            ->get();
        return view("blog",['posts' => $posts, 'i' => $i, 'active' => $active, 'all_tags' => $all_tags, 'similiar_posts' => $similiar_posts]);
    }

    public function edit_post($id, $msg = null){
        $post = Post::find($id);
        if($post == null){
            return $this->all_posts();
        }
        if($msg == null){
            return view('admin.edit',['post' => $post]);
        } else{
            return view('admin.edit',['post' => $post, 'msg' => $msg]);
        }    
    }

    public function edit_request(Request $request, $id){
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'tags' => 'required|string|max:255',
            'img_desc' => 'string',
        ]);

        $post = Post::find($id);
        if($post == null){
            return $this->all_posts(); 
        }

        $post->title = $data['title'];
        $post->description = $data['description'];
        $post->tags = $data['tags'];
        if($request->has('image')){
            $extension = $request->file('image')->getClientOriginalExtension();

        if(!$this->validateImgExtension($extension)){

            $err_msg = "Unsupported Image Format";
            return $this->edit_post($id,$err_msg);

        }

        $path = $request->file('image')->store('images');

        //$manager = new ImageManager();
        //dd(asset('storage/'.$path));
        
        $image = Image::make('storage/'.$path)->resize(730, 500);
        $image->save('storage/'.$path);

        $post->image = $path;
        }

        $post->img_desc = $data['img_desc'];
        $post->save();

        return $this->all_posts();
    }

    public function delete_post($id){
        $post = Post::find($id);

        if($post == null){
            return $this->all_posts();
        }
        $post->delete();
        return $this->all_posts();
    }

    public function index_posts(){
        $top_posts = Post::orderBy('created_at', 'desc')->get();
        $posts = Post::orderBy('created_at', 'desc')
                        ->inRandomOrder()
                        ->limit(3)
                        ->get();
        $i = 1;
        $all_tags = $this->fetch_tags();
        $similiar_posts = Post::orderBy('created_at', 'desc')
                            ->limit(6)
                            ->get();
        return view('index',['top_posts' => $top_posts, 'posts' => $posts, 'i' => $i, 'all_tags' => $all_tags, 'similiar_posts' => $similiar_posts]);

    }

    public function all_comments(){
        $i = 1;
        $comments = Comment::orderBy('created_at', 'desc')->get();
        return view("admin.comments",['comments' => $comments, 'i' => $i]);
    }

    public function view_post($id){
        $post = Post::find($id);
        $num_comments = Comment::orderBy('created_at', 'desc')
                        ->where("post_id","=", $post->id)
                        ->where("publish", "=", "true")
                        ->get();
        if($post == null){
            return $this->index_posts();
        }
        $all_tags = $this->fetch_tags();
        $similiar_posts = Post::orderBy('created_at', 'desc')
                            ->where("id", "<>", $post->id)
                            ->orWhere("tags", "LIKE", '%'.$post->tags.'%')
                            ->limit(6)
                            ->get();
                            
        return view('post-details',['post' => $post, 'all_tags' => $all_tags, 'similiar_posts' => $similiar_posts, "num_comments" => $num_comments]);
    }

    public function view_comment($id){
        $comment = Comment::find($id);
        if($comment == null){
            return $this->all_comments();
        }
        return view('admin.view-comment',['comment' => $comment]);
    }

    public function publish_comment($id){
        $comment = Comment::find($id);
        $comment->publish = "true";
        $comment->save();
        return $this->all_comments();
    }

    public function delete_comment($id){
        $comment = Comment::find($id);

        if($comment == null){
            return $this->all_comments();
        }
        $comment->delete();
        return $this->all_comments();
    }

    public function add_comment(Request $request){
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'comment' => 'required|string',
            'location' => 'required|string|max:255',
            'post_id' => 'required',
            'post_title' => 'string',
        ]);

        //dd($request)
        $comment = Comment::create([
            'name' => $data['name'],
            'comment' => $data['comment'],
            'location' => $data['location'],
            'post_id' => $data['post_id'],
            'publish' => 'false',
        ]);

        require'../vendor/autoload.php';

        // Replace sender@example.com with your "From" address.
        // This address must be verified with Amazon SES.
        $sender = env('MAIL_USERNAME');
        $senderName = $data['name'];
        $email = $data['location'];
        $comment = $data['comment'];

        // Replace recipient@example.com with a "To" address. If your account
        // is still in the sandbox, this address must be verified.
        $recipient = 'info@primepages.co.uk';

        // Replace smtp_username with your Amazon SES SMTP user name.
        $usernameSmtp = env('MAIL_USERNAME');

        // Replace smtp_password with your Amazon SES SMTP password.
        $passwordSmtp = env('MAIL_PASSWORD');

        // Specify a configuration set. If you do not want to use a configuration
        // set, comment or remove the next line.
        // $configurationSet = 'ConfigSet';

        // If you're using Amazon SES in a region other than US West (Oregon),
        // replace email-smtp.us-west-2.amazonaws.com with the Amazon SES SMTP
        // endpoint in the appropriate region.
        $host = env('MAIL_HOST');
        $port = env('MAIL_PORT');

        // The subject line of the email
        $subject = 'New comment for'. $data['post_title'].' blog post';

        // The plain-text body of the email
        $bodyText =  "$senderName \r\n $comment";

        // The HTML-formatted body of the email
        $bodyHtml = '<h6>'.$senderName.'</h6>
            <p>'.$email.'</p>
            <p>'.$comment.'</p>';

        $mail = new PHPMailer(true);

        try {
            // Specify the SMTP settings.
            $mail->isSMTP();
            $mail->setFrom($sender, $senderName);
            $mail->Username   = $usernameSmtp;
            $mail->Password   = $passwordSmtp;
            $mail->Host       = $host;
            $mail->Port       = $port;
            $mail->SMTPAuth   = true;
            $mail->SMTPSecure = 'ssl';
            // $mail->addCustomHeader('X-SES-CONFIGURATION-SET', $configurationSet);

            // Specify the message recipients.
            $mail->addAddress($recipient);
            // You can also add CC, BCC, and additional To recipients here.

            // Specify the content of the message.
            $mail->isHTML(true);
            $mail->Subject    = $subject;
            $mail->Body       = $bodyHtml;
            $mail->AltBody    = $bodyText;
            $mail->Send();
            return response()->json(['success' => 'Thank you, your comment is under review.']);
        } catch (phpmailerException $e) {
            // echo "An error occurred. {$e->errorMessage()}", PHP_EOL; //Catch errors from PHPMailer.
            return response()->json(['error' => 'Error sending comment.']);
        } catch (Exception $e) {
            // echo "Email not sent. {$mail->ErrorInfo}", PHP_EOL; //Catch errors from Amazon SES.
            return response()->json(['error' => 'Error sending comment.']);
        }

        // if($comment != null){
        //     return response()->json(['success' => 'Thank you, your comment is under review.']);
        // } else {
        //     return response()->json(['error' => 'Error sending comment.']);
        // }
    }

    public function fetch_tags(){
        $temp_tags = Post::select('tags')->get();
        //echo $temp_tags;
        $untrimmed_tags = array();

        foreach($temp_tags as $temp_tag){
            if(!in_array($temp_tag['tags'], $untrimmed_tags)){
                array_push($untrimmed_tags,$temp_tag['tags']);
            }
        }

        $tags = array();

        foreach($untrimmed_tags as $untrimmed_tag){
            $exploded_tags = explode(",", $untrimmed_tag);
            foreach($exploded_tags as $exploded_tag){
                if(!in_array($exploded_tag, $tags)){
                    array_push($tags, $exploded_tag);
                }
            }
        }


        for($i =0; $i < count($tags); $i++){
            if(empty($tags[$i])){
                unset($tags[$i]);
            }
        }

        return $tags;
    }
}
