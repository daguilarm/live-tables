# Authorization

**Live Tables** use Authorization when you delete, update, create or view an item or when you delete multiple items. In these cases, the package check if we have authorization to performe the action.

For example, let's imagine we want to delete users. The first thing we would have to do is create a **Policy** for the `User` **Model**, or every time we try to delete a user the package will notify us that the operation could not be performed.

The action buttons and the bulk-delete button, only will be visibles if we have authorization from the **Policy**, let see an example:

```php
<?php

namespace App\Policies;

use App\Models\Question;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class QuestionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine if the user can create a new resource.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine if the given model can be viewed by the user.
     */
    public function view(User $user, Question $question): bool
    {
        return $user->id === $question->user_id;
    }

    /**
     * Determine if the given model can be edited by the user.
     */
    public function edit(User $user, Question $question): bool
    {
        return $user->id === $question->user_id;
    }

    /**
     * Determine if the given model can be deleted by the user.
     */
    public function delete(User $user, Question $question): bool
    {
        return false;
    }
}
```

We need to define the four states: `create`, `view`, `edit` and `delete`. In this example, we will see all the actions (the buttons) except the delete button. 

> :warning: Remember that the visualization of the action buttons, depedend on the authorization rules.
