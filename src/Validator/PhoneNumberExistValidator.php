<?php

namespace App\Validator;

use App\Repository\PhonebookRepository;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class PhoneNumberExistValidator extends ConstraintValidator
{
    /** @var PhonebookRepository */
    private $phonebookRepository;

    /**
     * @param PhonebookRepository $phonebookRepository
     */
    public function __construct(PhonebookRepository $phonebookRepository)
    {
        $this->phonebookRepository = $phonebookRepository;
    }


    public function validate($value, Constraint $constraint)
    {
        /* @var $constraint PhoneNumberExist */
        if (null === $value || '' === $value) {
            return;
        }

        $phonebook = $this->phonebookRepository->findOneBy(['phone' => $value]);

        if ($phonebook) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ value }}', $value)
                ->addViolation();
        }
    }
}
