<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    // Controller

// Tampilkan semua post
public function index()
{
  $posts = Post::all();
  
  return response()->json([
    'success' => true,
    'message' => 'List Semua Post',
    'data'    => $posts  
  ], 200);
}

// Tampilkan post berdasarkan ID
public function show($id)
{
  $post = Post::find($id);
  if (!$post) {
    return response()->json([
      'success' => false,
      'message' => 'Post Tidak Ditemukan'
    ], 404);
  }

  return response()->json([
    'success' => true,
    'message' => 'Detail Post',
    'data'    => $post
  ], 200);
}

// Tambah post baru
public function store(Request $request) 
{
  $post = Post::create($request->all());

  return response()->json([
    'success' => true,
    'message' => 'Post Berhasil Ditambahkan',
    'data'    => $post
  ], 201);
}

// Update post
public function update(Request $request, $id)
{
  $post = Post::find($id);

  if (!$post) {
    return response()->json([
      'success' => false,
      'message' => 'Post Tidak Ditemukan'
    ], 404);
  }

  $post->update($request->all());

  return response()->json([
    'success' => true,
    'message' => 'Post Berhasil Diupdate',
    'data'    => $post
  ], 200);
}

// Hapus post
public function destroy($id)
{
  $post = Post::find($id);

  if (!$post) {
    return response()->json([
      'success' => false,
      'message' => 'Post Tidak Ditemukan'
    ], 404);
  }

  $post->delete();

  return response()->json([
    'success' => true,
    'message' => 'Post Berhasil Dihapus'
  ], 200);
}
}
