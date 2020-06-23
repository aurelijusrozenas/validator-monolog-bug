<?php

declare(strict_types=1);

namespace App\Command;

use App\Entity\MyEntity;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class MyCommand extends Command
{
    /**
     * @var string|null The default command name
     */
    protected static $defaultName = 'app';
    /** @var EntityManagerInterface */
    private $entityManager;
    /** @var ValidatorInterface */
    private $validator;

    public function __construct(EntityManagerInterface $entityManager, ValidatorInterface $validator)
    {
        parent::__construct();
        $this->entityManager = $entityManager;
        $this->validator = $validator;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $symfonyStyle = new SymfonyStyle($input, $output);
        $myEntities = $this->entityManager->getRepository(MyEntity::class)->findAll();
        $myEntity = $myEntities[0] ?? null;
        if (!$myEntity) {
            $output->writeln('First run, creating entity...');
            $myEntity = (new MyEntity())->setUniqueField('very unique');
            $this->entityManager->persist($myEntity);
            $this->entityManager->flush();
            $output->writeln('Done.');
        }
        $output->writeln('Creating second entity with same unique field value...');
        $myEntity = (new MyEntity())->setUniqueField('very unique');
        $output->writeln('Validating entity. Validation must fail because of the UniqueEntity constraint in MyEntity...');
        $constraintViolationList = $this->validator->validate($myEntity);
        if ($constraintViolationList->count() === 0) {
            $symfonyStyle->error('Validation failed because it did not detect failing constraint.');
        } else {
            $symfonyStyle->success('Great! Everything is working correctly.');
        }

        return 0;
    }
}
