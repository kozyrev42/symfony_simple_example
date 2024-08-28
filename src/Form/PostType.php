<?php

namespace App\Form;

use App\Entity\Post;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Title',
                'constraints' => [
                    new NotBlank(['message' => 'Title обязательно для заполнения']),
                    new Length([
                        'max' => 5,
                        'maxMessage' => 'Title должен содержать не более {{ limit }} символов',
                    ]),
                ],
            ])
            ->add('body', TextareaType::class, [
                'label' => 'Body',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Post::class, // указывает Symfony, что данная форма связана с сущностью Post.
            // Это значит, что при использовании этой формы Symfony будет автоматически
            // преобразовывать данные формы в объект класса Post и обратно
            
            'csrf_protection' => false, // Отключение CSRF-защиты
        ]);
    }
}
