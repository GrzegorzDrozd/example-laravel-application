<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Terms>
 */
class TermsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'required_from' => new \DateTime('January 1'),
            'content' => '
<p>Dolorum voluptates et est eligendi consectetur incidunt qui velit. Nobis quaerat similique culpa deserunt. Et eius illum aut eum soluta consequuntur rerum iusto.</p>
<p>Dolorem amet ipsum molestias quia sequi corporis dolores quam. Quo magni repellendus est. Molestiae in et omnis maxime id libero consequatur.</p>
<p>Fuga maiores architecto tempore cumque sed. Vitae et eos est laboriosam sapiente qui et. Aspernatur mollitia dignissimos ut necessitatibus veniam qui.</p>
<p>Rerum quia facere et modi ut deleniti. Earum voluptas enim autem eveniet doloremque eos modi id. Tenetur qui quibusdam placeat quia mollitia quo. Numquam ea quam rem ea. Ex ratione ipsum recusandae accusamus ratione esse. Illum sunt rerum eos deleniti.</p>
<p>Perspiciatis illum tenetur porro ad. Rerum earum eius eius officiis voluptates veniam. Repellat qui voluptatem possimus deserunt quis. Et omnis qui exercitationem et. Dolor sapiente minus quidem dolorem sunt aut eos consequatur. Nobis similique officia sequi.</p>
'
        ];
    }
}
