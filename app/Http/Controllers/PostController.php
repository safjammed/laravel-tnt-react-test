<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use TeamTNT\TNTSearch\Indexer\TNTIndexer;
use function foo\func;

class PostController extends Controller
{
    //
    public function search(Request $request){
        $request->validate([
           'query' => 'required|string'
        ]);

        $query = $request->input('query');
        $results = (Post::search($query)->get()->map(function ($post){
//            $post->user;
            $output = clone $post;
            $output->writer = $post->user->name;
            $output->category = $post->category->name;
            return $output;
        }));

//        return levenshtein($query, "French lesson-book. The Mouse gave a look.");

//        return ['first' => $results->first(), 'match' => $this->isExactMatch($query, $results->first())];
        if ($results->count() && $this->isExactMatch($query, $results->first())){

           return [
                'didyoumean' => false,
                'results' => $results
            ];

        }

        return [
            'didyoumean' => true,
            'results' => $this->getSuggestions($query)
        ];

    }
    private function getSuggestions($query){
        $indexer = new TNTIndexer;
        $trigrams = $indexer->buildTrigrams($query);
//        return $trigrams;
        $suggestions = Post::search($trigrams)->take(500)->get()->map(function ($post){
//            $post->user;
            $output = clone $post;
            $output->writer = $post->user->name;
            $output->category = $post->category->name;
            return $output;
        });

        return $this->sortByLevenshteinDistance($suggestions, $query);
    }

    private function sortByLevenshteinDistance($suggestions, $query){
        /*return $suggestions->map(function ($post) use ($query){
            $post->distance = levenshtein($query, $post->name);
            return $post;
        });*/
        $suggestions = $suggestions->filter(function($post) use ($query){
            $post->distance = levenshtein($query, $post->name);
            if ($post->distance < 70){
                return true;
            }
            return false;
        })->sort(function($a, $b){
            return $a->distance < $b->distance ? -1 : 1;
        });

        return $suggestions;
    }

    private function isExactMatch($query, $itm){
        //if the query exists in the post title or writer or category name
        return ($itm)? in_array(strtolower($query), [
            strtolower($itm->name),
            strtolower($itm->writer),
            strtolower($itm->category)
        ]) :false;
    }
}
