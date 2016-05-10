<?php

namespace App\Http\Controllers\Admin;

use App\Book;
use App\Http\Requests\BookRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Session;
use Flash;

class BooksController extends Controller
{
    /**
	 * Handle the books listing
	 * 
	 * @return string
	 */
	public function index() {
		
		$books = Book::latest()->paginate(10);
		
		return view('admin.books.index', compact('books'));
	}

	/**
	 * Handle the new book form
	 * 
	 * @return string
	 */
	public function create() {
		
		$book = new Book();
		
		return view('admin.books.new', compact('book'));
	}

	/**
	 * Handle show the update form
	 * 
	 * @param Book $book
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function edit(Book $book) {
		
		return view('admin.books.edit', compact('book'));
	}

	/**
	 * Method to handle update book
	 * 
	 * @param Request $request
	 * @param Book $book
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function update(BookRequest $request, Book $book) {
		
		$data = $request->all();
		
		$releasedAt = Carbon::createFromFormat('m/d/Y',$data['released_at']);
		
		if($releasedAt) {
			
			$book->released_at = $releasedAt;
		}
		
		unset($data['released_at']);
		
		$book->update($data);
		
		Flash::success('Successfully updated information for '. $book->title);
		
		return redirect()->route('admin.books.index');
	}
	
	public function handleCreate(BookRequest $request) {
		
		$data = $request->all();
		
		$releasedAt = Carbon::createFromFormat('m/d/Y',$data['released_at']);
		
		if($releasedAt) {
			
			$data['released_at'] = $releasedAt;
		}
		else {
			
			unset($data['released_at']);
		}
		
		if($book = Book::create($data)) {
			
			Flash::success('Successfully added book '.$book->title);
		}
		else {
			
			Flash::error('Failed to create the book. Please try again');
		}
		
		return redirect()->route('admin.books.index');
	}

	/**
	 * Method to handle delete the Book
	 * 
	 * @param Book $book
	 * @return \Illuminate\Http\RedirectResponse
	 * @throws \Exception
	 */
	public function destroy(Book $book) {
		
		$bookTitle = $book->title;
		
		if($book->delete()) {
			
			Flash::success('Successfully deleted book '.$bookTitle);
		}
		else {
			
			Flash::error('Failed to delete book '.$bookTitle);
		}
		
		return redirect()->back();
	}
}
