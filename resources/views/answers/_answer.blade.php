<answer :answer="{{ $answer }}" inline-template>
    <div class="media post my-4">
        <vote :model="{{ $answer }}" name="answer"></vote>
        <div class="media-body">
            <form v-if="editing" @submit.prevent="update">
                <div class="form-group">
                    <textarea v-model="body" class="form-control" rows="10" required>
                    </textarea>
                </div>
                <button class="btn btn-primary" :disabled="isInvalid">Update</button>
                <button class="btn btn-outline-secondary" @click="cancel">Cancel</button>
            </form>
            <div v-else>
                <div v-html="bodyHtml"></div>
                <div class="row">
                    <div class="col-4">
                        <div class="ml-auto">
                            @can ('update', $answer)
                                <a @click.prevent="edit" href="{{ route('questions.answers.edit', [$question->id, $answer->id]) }}" class="btn btn-sm btn-outline-info">
                                    Edit
                                </a>   
                            @endcan
                            @can ('delete', $answer)
                                <button class="btn btn-sm btn-outline-danger" @click="destroy">
                                    Delete
                                </button>        
                            </form>
                            @endcan
                        </div>
                    </div>
                    <div class="col-4">
                    </div>
                    <div class="col-4">
                        <user-info :model="{{ $answer }}" label="Answered"></user-info>
                    </div>
                </div>
            </div>
        </div> 
    </div>
</answer>