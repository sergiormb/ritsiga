<?php
/**
 * Created by PhpStorm.
 * User: tfg
 * Date: 22/04/15
 * Time: 11:31
 */

namespace AppBundle\Process;


use Sylius\Bundle\FlowBundle\Process\Builder\ProcessBuilderInterface;
use Sylius\Bundle\FlowBundle\Process\Scenario\ProcessScenarioInterface;
use Symfony\Component\DependencyInjection\ContainerAware;
use AppBundle\Process\Step;

class SyliusScenario extends ContainerAware implements ProcessScenarioInterface
{
    public function build(ProcessBuilderInterface $builder)
    {
        $builder
            ->add('welcome', new Step\WelcomeStep())
            ->add('university', new Step\UniversityStep())
            ->add('college', new Step\CollegeStep())
            ->add('student_delegation', new Step\StudentDelegationStep())
            ->add('responsible', new Step\ResponsibleStep())
            ->setRedirect('registration_open')
        ;
    }
}