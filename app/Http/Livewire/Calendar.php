<?php
namespace App\Http\Livewire;
use Livewire\Component;
use App\Models\Activity;

class Calendar extends Component
{
    public $events = '';

    public function getevent()
    {
        $events = Activity::select('id','title','start','end')->get();

        return  json_encode($events);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
//    public function addevent($event)
//    {
//        $input['name'] = $event['name'];
//        $input['from_time'] = $event['from_time'];
//        $input['due_time'] = $event['due_time'];
//        Activity::create($input);
//    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function eventDrop($event, $oldEvent)
    {
        $eventdata = Activity::find($event['id']);
        $eventdata->start = $event['start'];
        $eventdata->end = $event['end'];
        $eventdata->save();
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function delete($event)
    {
        $eventdata = Activity::find($event['id']);
        $this->eventdata->delete();
        return json_encode($eventdata);
    }


    public function render()
    {


        $events = Activity::select('id','title','start','end')->where('is_done',0)->get();

        $this->events = json_encode($events);

        return view('livewire.calendar');
    }
}
