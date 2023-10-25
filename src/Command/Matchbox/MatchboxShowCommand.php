<?php

namespace App\Command\Matchbox;

use App\Model\Matchbox\MatchboxDto;
use App\Repository\MatchboxRepository;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'app:matchbox:show')]
class MatchboxShowCommand extends Command
{
    public function __construct(
        private readonly MatchboxRepository $matchboxRepository,
    ){
        parent::__construct();
        $this
            ->addArgument(
                'manufacturer',
                InputArgument::OPTIONAL,
                'Показать коробки конкретного производителя'
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $formatter = $this->getHelper('formatter');
        $manufacturerName = $input->getArgument('manufacturer');

        if ($manufacturerName){
            $matchboxes = $this->matchboxRepository->findDTO(
                manufacturer: $manufacturerName,
            );
            if (!$matchboxes){
                $output->writeln([
                    $formatter->formatBlock('Производитель не существует', 'error')
                ]);
                return Command::FAILURE;
            }
        }

        if (!isset($matchboxes)) $matchboxes = $this->matchboxRepository->findDTO();

        $this->showMatchboxes($matchboxes, $output);

        return Command::SUCCESS;
    }

    private function showMatchboxes(array|Collection $matchboxes, OutputInterface $output)
    {
        foreach ($matchboxes as $matchbox)
        {
            $this->showOneMatchbox($matchbox, $output);
        }
    }

    private function showOneMatchbox(MatchboxDto $matchbox, OutputInterface $output)
    {
        $formatter = $this->getHelper('formatter');
        $output->writeln([
            $formatter->formatSection('Производитель', $matchbox->getManufacturer()),
            $formatter->formatSection('Назначение', $matchbox->getPurpose()),
            $formatter->formatSection('Количество спичек в коробке', $matchbox->getCount()),
            $formatter->formatSection('Длина спички', $matchbox->getLength()),
            ($matchbox->getDescription())?
            $formatter->formatSection('Описание', $matchbox->getDescription())."\n":
            '',
        ]);
    }
}