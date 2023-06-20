<?php

namespace Database\Seeders;

use App\Models\Specialization;
use Illuminate\Database\Seeder;

class SpecaializationSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Specialization::create([
            'name' => 'Small Animal Medicine and Surgery',
            'description' => 'Specializing in the medical and surgical treatment of domestic pets such as dogs, cats, and small mammals',
        ]);

        Specialization::create([
            'name' => 'Large Animal Medicine and Surgery',
            'description' => 'Focusing on the health and treatment of large animals, including livestock such as cattle, horses, pigs, and poultry.',
        ]);

        Specialization::create([
            'name' => 'Equine Medicine',
            'description' => 'Specializing in the care and treatment of horses, including medical conditions, surgery, reproduction, and sports medicine.',
        ]);

        Specialization::create([
            'name' => 'Wildlife and Conservation Medicine',
            'description' => 'Dealing with the health and management of wild animals, including rehabilitation, conservation, and disease control.',
        ]);

        Specialization::create([
            'name' => 'Exotic Animal Medicine',
            'description' => 'Specializing in the care and treatment of exotic pets and non-traditional companion animals such as reptiles, amphibians, and small mammals.',
        ]);

        Specialization::create([
            'name' => 'Aquatic Veterinary Medicine',
            'description' => 'Focusing on the health and diseases of aquatic animals, including fish, shellfish, and marine mammals.',
        ]);

        Specialization::create([
            'name' => 'Veterinary Pathology',
            'description' => 'Involves the study of animal diseases through laboratory analysis, including diagnostic testing, tissue examination, and post-mortem evaluations.',
        ]);
        Specialization::create([
            'name' => 'Veterinary Dermatology',
            'description' => 'Specializing in the diagnosis and treatment of skin diseases and allergies in animals.',
        ]);
        Specialization::create([
            'name' => 'Veterinary Ophthalmology',
            'description' => 'Focusing on the diagnosis and treatment of eye conditions and diseases in animals.',
        ]);
    }
}
