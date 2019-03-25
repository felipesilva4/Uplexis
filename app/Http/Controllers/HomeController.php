<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Http\Requests\FindRequest;
use App\Artigo;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function find(FindRequest $request){
        $url = 'https://www.uplexis.com.br/blog/';
        $dataSite = file_get_contents($url);

        //mostrar parte pesquisado do blog
        $var1 = explode($request->text,$dataSite);
        isset($var1[1])?  $var2 = explode('</a>',$var1[1]):"";

        if (isset($var2[0])){
            //extraindo href
            $link = explode('href=',$var2[0]);
            $link = explode('class="btn-uplexis orange">',$link[1]);

            //armazenando href extraída para variavel 
            $blog_link = $link[0];
            $blog_link = str_replace('"','',$blog_link);
        } 
       isset($var2[0])?
       print 
            '
            <form  action="/captura" method="get">
                <p> Você pesquisou: '.$request->text.'</p>
                '.$var2[0].
                '<input type="text" style="display:none" name="title" value='.$request->text.'>
                <input type="text"  style="display:none" name="link"  value='.$blog_link.'></br>
                <input type="submit"  value="Capturar">
                </br><a href="/">VOLTAR</a>
            </form>'
            : print  '<div><p> Você pesquisou: '.$request->text.'<p> Não encontrado </p></div>';

    }
    public function store (Request $request){
        $artigo = new Artigo;
        $artigo->title = $request->title;
        $artigo->link = $request->link;
        $artigo->user_id = auth()->user()->id;
        $artigo->save();

        $artigos = Artigo::where('user_id', auth()->user()->id)->get();
       
        return view('home',  ['artigos' =>  $artigos ]);
    }
    public function delete($id)
    {
        $artigos = Artigo::findOrFail($id);
        $artigos->delete();

        print 'artigo removido!';
    }
}
