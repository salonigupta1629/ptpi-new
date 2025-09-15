<!-- 

namespace App\Livewire\Teacher\Exam;

use Livewire\Attributes\Layout;
use Livewire\Component;

class Instruction extends Component
{
    // public $selection = [
    //     'category_id' => request()->query('category_id'),
    //     'subject_id'  => request()->query('subject_id'),
    //     'level_id' => request()->query('level_id')
    // ];
    public $categoryId, $subjectId, $levelId;
    public function mount($category, $subject, $level)
    {
        $this->categoryId = $category;
        $this->subjectId = $subject;
        $this->levelId = $level;
    }

    public function proceedToExam()
    {
        return redirect()->route('teacher.exam-portal', [
            $this->categoryId,
            $this->subjectId,
            $this->levelId
        ]);
    }
    public function backToDashboard()
    {
        return redirect()->route('teacher.dashboard');
    }
    #[Layout('layouts.teacher')]
    public function render()
    {
        return view('livewire.teacher.exam.instruction');
    }
} -->
