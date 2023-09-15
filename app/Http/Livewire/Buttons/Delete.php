<?php

namespace App\Http\Livewire\Buttons;

use App\Models\Post;
use Illuminate\Support\Facades\File;
use Livewire\Component;

class Delete extends Component
{
    public  $post;
    public  $confirmingPostDeletion = false;

    public function confirmPostDeletion()
    {
        // https://www.youtube.com/watch?v=WjD0bTCLGg0&list=PL1JpS8jP1wgC8Uud_DKhL3jAtcPzeQ9pn&index=11
        // dump($this->confirmingPostDeletion); // 打印当前状态
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('confirming-delete-post');
        $this->confirmingPostDeletion = true;
    }
    public function deletePost($id)
    {
        // 先删除图片
        File::delete(
            storage_path('app/public/images/' . $this->post->cover_image)
        );
        // 再 删除post
        $this->post->delete();

        session()->flash('success', 'Post deleted');
        return redirect()->route('posts.index');
    }
    public function render()
    {
        return view('livewire.buttons.delete');
    }
}
